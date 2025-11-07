<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IEstadoPostulacion.php";

class EstadoPostulacionGateway implements IEstadoPostulacion{

     public function listarEstadoPostulacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM estadoPostulacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }
}