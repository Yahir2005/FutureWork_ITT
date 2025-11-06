<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IEmpresa.php";

class EmpresaGateway implements IEmpresa{

    public function listarEmpresas():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Empresas";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}