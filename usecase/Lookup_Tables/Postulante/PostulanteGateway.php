<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IPostulante.php";

 class PostulanteGateway implements IPostulante{
    public function listarPostulante (): array{ 
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Postulante";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
     public function insertarPostulante (Postulante $Postulante):int {
        $mysqlConnector = new MysqlConnector();
        $query = "INSERT INTO Postulante (Carrera_idCarrera,Usuarios_idUsuarios,
        numeroControl,
        cvPath,
        telefono,
        ubicacion) VALUES ('{$Postulante->get('Carrera_idCarrera')}',
        '{$Postulante->get('Usuarios_idUsuarios')}',
        '{$Postulante->get('numeroControl')}',
        '{$Postulante->get('cvPath')}',
        '{$Postulante->get('telefono')}',
        '{$Postulante->get('ubicacion')}'')";
        $mysqlConnector = new MysqlConnector();
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
    public function actualizarPostulante ($id, $Postulante):int {
         $mysqlConnector = new MysqlConnector();
        $query = "UPDATE Postulante SET 
         Carrera_idCarrera= '{$Postulante->get('Carrera_idCarrera')}',
         Usuarios_idUsuarios = '{$Postulante->get('Usuarios_idUsuarios')}',
         numeroControl = '{$Postulante->get('numeroControl')}',
         cvPath = '{$Postulante->get('cvPath')}',
         telefono = '{$Postulante->get('telefono')}',
         ubicacion = '{$Postulante->get('ubicacion')}', 
        WHERE idPostulante = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
     public function listarPostulantePorNombre($Nombre):array{
      $mysqlConnector = new MysqlConnector();
      $sql = "SELECT * FROM Postulante WHERE nombreEmpresa LIKE '%$Nombre%'";
      $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
     public function eliminarPostulante ($id):int{
        $mysqlConnector = new MysqlConnector();
        $query = "DELETE FROM Postulante WHERE idPostulante = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
    }


 