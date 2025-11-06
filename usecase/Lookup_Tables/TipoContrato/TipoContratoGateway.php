<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/ITipoContrato.php";

class TipoContratoGateway implements ITipoContrato{

    public function listarTipoContrato(): array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM TipoContrato";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}