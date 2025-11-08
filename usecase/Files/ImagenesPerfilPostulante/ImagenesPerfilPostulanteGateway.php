<?php
require_once __DIR__ . "/IImagenesPerfilPostulante.php";
require_once __DIR__ . "/../../DataAccess/MysqlConnector.php";

class ImagenesPerfilPostulanteGateway implements IImagenesPerfilPostulante{
    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO ImagenesPerfilPostulante (Postulante_idPostulante,
        urlImagenPerfilPostulante) VALUES ('{$imagenesPerfilPostulante->get('Postulante_idPostulante')}', 
        '{$imagenesPerfilPostulante->get('urlImagenPerfilPostulante')}')";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
}