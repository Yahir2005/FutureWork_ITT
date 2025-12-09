<?php
require_once __DIR__ . "/ITipoModalidad.php";
require_once __DIR__ . "/../../../Dto/TipoModalidad.php";
require_once __DIR__ . "/../../DataAccess/MysqlConnector.php";

class TipoModalidadGateway implements ITipoModalidad{
    public function listarTipoModalidad():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM TipoModalidad";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}