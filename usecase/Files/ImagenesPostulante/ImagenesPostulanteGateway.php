<?php
require_once __DIR__ ."/IImagenesPostulante.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenesPostulanteGateway implements IImagenesPostulante{
    public function InsertarImagenPostulante(ImagenesPostulante $imagenesPostulante):int{
    $mysqlConnector = new MysqlConnector();
    $sql = "INSERT INTO ImagenesPostulante (Postulante_idPostulante, urlImagen) VALUES ('{$imagenesPostulante->get('Postulante_idPostulante')}',
    '{$imagenesPostulante->get('urlImagen')}')";
    $result = $mysqlConnector->consultaSimple($sql);
    return $result;
    }
   
    public function eliminarImagen($id):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM ImagenesPostulante WHERE idImagenPostulante = '{$id}'";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function obtenerImagenes():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM ImagenesPostulante";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}