<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IPostulantes.php";
require_once __DIR__ . "/../../Dto/Postulante.php";

class PostulanteGateway implements IPostulantes {

    public function InsertarPostulante(Postulante $postulante): int {
        $mysqlConnector = new MysqlConnector();
        // Corrección: Faltaban comas y el campo 'telefono' en el VALUES
        $sql = "INSERT INTO Postulante (
            Carrera_idCarrera,
            Usuarios_idUsuarios,
            numeroControl,
            cvPath,
            telefono,
            ubicacion
        ) VALUES (
            '{$postulante->get('Carrera_idCarrera')}',
            '{$postulante->get('Usuarios_idUsuarios')}',
            '{$postulante->get('numeroControl')}',
            '{$postulante->get('cvPath')}',
            '{$postulante->get('telefono')}',
            '{$postulante->get('ubicacion')}'
        )";
        
        // Retorna el ID insertado
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ListarPostulantes(): array {
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Postulante";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ActualizarPostulante($id, Postulante $postulante): int {
        $mysqlConnector = new MysqlConnector();
        $sql = "UPDATE Postulante SET 
            Carrera_idCarrera = '{$postulante->get('Carrera_idCarrera')}',
            numeroControl = '{$postulante->get('numeroControl')}',
            cvPath = '{$postulante->get('cvPath')}',
            telefono = '{$postulante->get('telefono')}',
            ubicacion = '{$postulante->get('ubicacion')}'
        WHERE idPostulante = {$id}";
        
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function EliminarPostulante($id): int {
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM Postulante WHERE idPostulante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ObtenerPostulantePorIdUsuario($id): array {
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT p.*, u.nombreCompleto, u.email 
                FROM Postulante p
                INNER JOIN Usuarios u ON p.Usuarios_idUsuarios = u.idUsuarios
                WHERE p.Usuarios_idUsuarios = {$id}";
                
        $result = $mysqlConnector->consultaRetorno($sql);
        
        $data = mysqli_fetch_assoc($result);
        return $data ? $data : []; 
    }
}