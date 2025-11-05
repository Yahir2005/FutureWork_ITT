<?php
require_once __DIR__ . '/IEstadoValidacionEmpresa.php'; 
require_once __DIR__ . '/../../DataAccess/MysqlConnector.php';

class EstadoValidacionEmpresaGateway implements IEstadoValidacionEmpresa {

    public function ListarValidacionesEmpresa():array{
        $mysqlConnector = new MysqlConnector();
        $query = "SELECT *FROM EstadoValidacionEmpresa";
        $result = $mysqlConnector->consultaRetorno( $query );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarValidacionesEmpresaId($id):array{
        $mysqlConnector = new MysqlConnector();
        $query = "SELECT *FROM EstadoValidacionEmpresa WHERE idEstadoValidacionEmpresa = $id";
        $result = $mysqlConnector->consultaRetorno( $query );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}