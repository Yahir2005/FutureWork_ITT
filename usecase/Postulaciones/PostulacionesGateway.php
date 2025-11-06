<?php
require_once __DIR__ ."/../DataAccess";
require_once __DIR__ ."/IPostulaciones.php";
require_once __DIR__ ."/../../Dto/Postulacion.php";
class PostulacionesGateway implements IPostulaciones{

    public function InsertarPostulacion(Postulaciones $postulacion):int{
        $mysqlConnector = new MysqlConnector();
        $query = "INSERT INTO Postulaciones (Postulante_idPostulante,
        Vacante_idVacante,
        EstadoPostulacion_idEstadoPostulacion,
        fechaPostulacion)
        VALUES ('{$postulacion->get('Postulante_idPostulante')}',
        '{$postulacion->get('Vacante_idVacante')}',
        '{$postulacion->get('EstadoPostulacion_idEstadoPostulacion')}',
        '{$postulacion->get('fechaPostulacion')}')";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }
}