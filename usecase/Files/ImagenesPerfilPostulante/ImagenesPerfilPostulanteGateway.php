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

    public function EliminarImagenPerfilPostulante($id):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM ImagenesPerfilPostulante WHERE idImagenPostulante = '{$id}'";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function MostrarImagenPerfilPostulante($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM ImagenesPerfilPostulante WHERE idImagenPostulante = '{$id}'";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}