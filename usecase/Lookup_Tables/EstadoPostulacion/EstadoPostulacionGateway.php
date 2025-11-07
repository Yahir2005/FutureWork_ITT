<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "IEstadoPostulacion";

class EstadoPostulacionGateway implements IEstadoPostulacion{

     public function listarEstadoPostulacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM EstadoPostulacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
        
     }
}