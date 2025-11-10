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
}