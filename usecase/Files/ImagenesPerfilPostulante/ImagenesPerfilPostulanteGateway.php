<?php
require_once __DIR__ . "/IImagenesPerfilPostulante.php";
require_once __DIR__ . "/../../DataAccess/MysqlConnector.php";

class ImagenesPerfilPostulanteGateway implements IImagenesPerfilPostulante{
    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO ";
    }
}