<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IPostulante.php";

 class PostulanteGateway implements IPostulante{
    public function listarPostulante (): array{ 
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Postulante";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function insertarPostulante (Postulante $postulante):int {
        $mysqlConnector = new MysqlConnector();
        $query = "INSERT INTO Postulante (Carrera_idCarrera,Usuarios_idUsuarios,
        numeroControl,
        cvPath,
        telefono,
        ubicacion) VALUES ('{$postulante->get('Carrera_idCarrera')}',
        '{$postulante->get('Usuarios_idUsuarios')}',
        '{$postulante->get('numeroControl')}',
        '{$postulante->get('cvPath')}',
        '{$postulante->get('telefono')}',
        '{$postulante->get('ubicacion')}'')";
        $mysqlConnector = new MysqlConnector();
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
    public function actualizarPostulante ($id, $postulante):int {
         $mysqlConnector = new MysqlConnector();
        $query = "UPDATE Postulante SET 
         Carrera_idCarrera= '{$postulante->get('Carrera_idCarrera')}',
         Usuarios_idUsuarios = '{$postulante->get('Usuarios_idUsuarios')}',
         numeroControl = '{$postulante->get('numeroControl')}',
         cvPath = '{$postulante->get('cvPath')}',
         telefono = '{$postulante->get('telefono')}',
         ubicacion = '{$postulante->get('ubicacion')}', 
        WHERE idPostulante = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
     public function eliminarPostulante ($id):int{
        $mysqlConnector = new MysqlConnector();
        $query = "DELETE FROM Postulante WHERE idPostulante = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }

    public function listarPostulantePorNombre($Nombre):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT U.idUsuarios,
        U.Rol_idRol,
        U.nombreCompleto,
        U.email,
        U.fechaRegistro,
        P.telefono,
        P.cvPath,
        C.nombreCarrera
        FROM Postulante P
        INNER JOIN Usuarios U ON P.Usuarios_idUsuarios = U.idUsuarios
        INNER JOIN Carrera C ON P.Carrera_idCarrera = C.idCarrera
        WHERE U.nombreCompleto LIKE '%$Nombre%'";
        $result = $mysqlConnector->consultaSimple($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}