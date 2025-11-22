<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IHabilidades.php";

class HabilidadesGateway implements IHabilidades{

     public function listarHabilidades():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM Habilidades";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }
}