<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPostulanteUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPostulante $gatewayDB){
        $this->gatewayDb = $gatewayDB;
    }

    public function InsertarImagenPostulante(ImagenesPostulante $imagenesPostulante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->InsertarImagenPostulante($imagenesPostulante);
        try {
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se a insertado correctamente la imagen";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen". $e->getMessage();
        }
        return $response;
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->eliminarImagen($id);
        try {
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se a eliminado correctamente la imagen";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al eliminar la imagen". $e->getMessage();
        }
        return $response;
    }

    public function obtenerImagenes():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->obtenerImagenes();
        try {
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se han obtenido correctamente las imagenes";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al obtener las imagenes". $e->getMessage();
        }
        return $response;
    }
}