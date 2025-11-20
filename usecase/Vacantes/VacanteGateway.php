<?php
require_once __DIR__ ."/IVacante.php";
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";

class VacanteGateway implements IVacante{
    public function InsertarVacante(Vacantes $vacantes):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO Vacantes (
            Empresa_idEmpresa,
            EstadoValidacionVacante_idEstadoValidacionVacante, 
            TipoContrato_idTipoContrato, 
            TipoModalidad_idTipoModalidad,
            titulo,
            descripcion,
            requisitos,
            ubicacion,
            salario,
            fechaLimite
        ) VALUES (
            '{$vacantes->get('Empresa_idEmpresa')}',
            '{$vacantes->get('EstadoValidacionVacante_idEstadoValidacionVacante')}',
            '{$vacantes->get('TipoContrato_idTipoContrato')}',
            '{$vacantes->get('TipoModalidad_idTipoModalidad')}',
            '{$vacantes->get('titulo')}',
            '{$vacantes->get('descripcion')}',
            '{$vacantes->get('requisitos')}',
            '{$vacantes->get('ubicacion')}',
            '{$vacantes->get('salario')}',
            '{$vacantes->get('fechaLimite')}'
        )";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ActualizarVacante($id, $vacantes):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "UPDATE Vacantes SET 
            Empresa_idEmpresa = '{$vacantes->get('Empresa_idEmpresa')}',
            EstadoValidacionVacante_idEstadoValidacionVacante = '{$vacantes->get('EstadoValidacionVacante_idEstadoValidacionVacante')}',
            TipoContrato_idTipoContrato = '{$vacantes->get('TipoContrato_idTipoContrato')}',
            TipoModalidad_idTipoModalidad = '{$vacantes->get('TipoModalidad_idTipoModalidad')}',
            titulo = '{$vacantes->get('titulo')}',
            descripcion = '{$vacantes->get('descripcion')}',
            requisitos = '{$vacantes->get('requisitos')}',
            ubicacion = '{$vacantes->get('ubicacion')}',
            salario = '{$vacantes->get('salario')}',
            fechaLimite = '{$vacantes->get('fechaLimite')}'
        WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function EliminarVacante($id):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM Vacantes WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ListarVacantes():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Vacantes";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarVacantesPorNombre($nombre):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Vacantes WHERE titulo LIKE '%{$nombre}%'";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarVacantesPorEmpresa($idEmpresa):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Vacantes WHERE Empresa_idEmpresa = {$idEmpresa}";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}