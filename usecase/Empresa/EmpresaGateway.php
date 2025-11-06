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

    public function insertarEmpresas(Empresa $empresa):int{
        $mysqlConnector = new MysqlConnector();
        $query = "INSERT INTO Empresas (Usuarios_idUsuarios,
        EstadoValidacionEmpresa_idEstadoValidacionEmpresa,
        nombreEmpresa,
        sector,
        representante, 
        descripcion, 
        sitioWeb) VALUES ('{$empresa->get('Usuarios_idUsuarios')}',
        '{$empresa->get('EstadoValidacionEmpresa_idEstadoValidacionEmpresa')}',
        '{$empresa->get('nombreEmpresa')}',
        '{$empresa->get('sector')}',
        '{$empresa->get('representante')}',
        '{$empresa->get('descripcion')}',
        '{$empresa->get('sitioWeb')}')";
        $mysqlConnector = new MysqlConnector();
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
}