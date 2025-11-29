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

    public function listarTipoContratoPorId($id): array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM TipoContrato WHERE idTipoContrato=".$id;
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
/*
CREATE TABLE TipoContrato(
    idTipoContrato INT AUTO_INCREMENT PRIMARY KEY,
    estadoContrato VARCHAR(45)
);
*/