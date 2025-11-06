<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/ICarrera.php";
class CarreraGateway implements ICarrera {
    public function listarCarrera ():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Carrera";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    
}
    