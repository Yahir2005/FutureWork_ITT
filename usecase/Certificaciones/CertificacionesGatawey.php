<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/ICertificaciones.php";

class CertificacionesGatawey implements ICertificaciones{
    public function insertarCertificacion(Certificaciones $certificaciones):int{
        $mysqlObj = new MysqlConnector();
        $sql = "INSERT INTO Certificaciones(nombre,
        organizacionEmisora,
        fechaObtencion,
        urlCredencial) VALUES
        ('{$certificaciones->get('nombre')}',
        '{$certificaciones->get('organizacionEmisora')}',
        '{$certificaciones->get('fechaObtencion')}',
        '{$certificaciones->get('urlCredencial')}')";
        $result = $mysqlObj->consultaSimple($sql);
        return $result;
    }
}
