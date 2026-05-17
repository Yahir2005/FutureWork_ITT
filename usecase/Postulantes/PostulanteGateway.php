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

    public function PerfilPostulante($id): array {
    $mysqlConnector = new MysqlConnector();
    $id = intval($id); // Sanitizar
    
    $sql = "SELECT 
        u.idUsuarios,
        u.nombreCompleto,
        u.email,
        r.nombreRol,
        c.nombreCarrera,
        cert.nombre AS nombreCertificacion,
        h.nombreHabilidad
    FROM Postulante p
    INNER JOIN Usuarios u 
        ON p.Usuarios_idUsuarios = u.idUsuarios
    INNER JOIN Rol r 
        ON u.Rol_idRol = r.idRol
    INNER JOIN Carrera c 
        ON p.Carrera_idCarrera = c.idCarrera
    LEFT JOIN Postulante_Certificacion pc 
        ON p.idPostulante = pc.Postulante_idPostulante
    LEFT JOIN Certificaciones cert 
        ON pc.Certificaciones_idCertificacion = cert.idCertificacion
    LEFT JOIN Postulante_Habilidades ph 
        ON p.idPostulante = ph.Postulante_idPostulante
    LEFT JOIN Habilidades h 
        ON ph.Habilidades_idHabilidad = h.idHabilidad
    WHERE p.Usuarios_idUsuarios = $id";
    
    $result = $mysqlConnector->consultaRetorno($sql);
    if (!$result) {
        throw new Exception("Error en la consulta SQL");
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

}