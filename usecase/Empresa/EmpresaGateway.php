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

    public function actualizarEmpresas($id, $empresa):int{
        $mysqlConnector = new MysqlConnector();
        $query = "UPDATE Empresas SET 
        Usuarios_idUsuarios = '{$empresa->get('Usuarios_idUsuarios')}',
        EstadoValidacionEmpresa_idEstadoValidacionEmpresa = '{$empresa->get('EstadoValidacionEmpresa_idEstadoValidacionEmpresa')}',
        nombreEmpresa = '{$empresa->get('nombreEmpresa')}',
        sector = '{$empresa->get('sector')}',
        representante = '{$empresa->get('representante')}',
        descripcion = '{$empresa->get('descripcion')}',
        sitioWeb = '{$empresa->get('sitioWeb')}' 
        WHERE idEmpresas = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }

    public function eliminarEmpresas($id):int{
        $mysqlConnector = new MysqlConnector();
        $query = "DELETE FROM Empresas WHERE idEmpresas = {$id}";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }

    public function buscarEmpresasPorNombre($Nombre):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Empresas WHERE nombreEmpresa LIKE '%$Nombre%'";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}