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
    /*public function listarPostulantePorNombre($Nombre):array{
      $mysqlConnector = new MysqlConnector();
      $sql = "SELECT * FROM Postulante WHERE nombreEmpresa LIKE '%$Nombre%'";
      $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }*/
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

}


 