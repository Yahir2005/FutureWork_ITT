<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IEstadoPostulacion.php";

class EstadoPostulacionGateway implements IEstadoPostulacion{

     public function listarEstadoPostulacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM EstadoPostulacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }

     public function listarEstadoPostulacionPorId($idEstadoPostulacion): array {
        $objSQL  = new MysqlConnector();
        $sql = "SELECT * FROM EstadoPostulacion WHERE idEstadoPostulacion = {$idEstadoPostulacion}";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
     }
    
}