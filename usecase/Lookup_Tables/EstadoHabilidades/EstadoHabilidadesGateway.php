<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IEstadoPostulacion.php";

class EstadoHabilidadesGateway implements IEstadoHabilidades{

     public function listarEstadoHabilidades():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM EstadoHabilidades";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }
}