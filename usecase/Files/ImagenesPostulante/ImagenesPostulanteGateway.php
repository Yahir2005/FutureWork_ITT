<?php
require_once __DIR__ ."/IImagenesPostulante.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenesPostulanteGateway implements IImagenesPostulante{
    public function obtenerImagenPostulante(ImagenesPostulante $imagenesPostulante):int{
    $mysqlConnector = new MysqlConnector();
    $sql = "INSERT INTO ImagenesPostulante VALUES ('{$imagenesPostulante->get('Postulante_idPostulante')}',
    '{$imagenesPostulante->get('urlImagen')}',)";
    $result = $mysqlConnector->consultaSimple($sql);
    return $result;
    }
   
}