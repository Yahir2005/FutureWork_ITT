<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPostulanteUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPostulante $gatewayDB){
        $this->gatewayDb = $gatewayDB;
    }

    public function InsertarImagenPostulante(ImagenesPostulante $imagenesPostulante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->InsertarImagenPostulante($imagenesPostulante);
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se a insertado correctamente la imagen";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen". $e->getMessage();
        }
        return $response;
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->eliminarImagen($id);
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se a eliminado correctamente la imagen";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al eliminar la imagen". $e->getMessage();
        }
        return $response;
    }

    public function obtenerImagenes():RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->obtenerImagenes();
            $response->status = "OK";
            $response->body = $respuestaMetodo;
            $response->message = "Se han obtenido correctamente las imagenes";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al obtener las imagenes". $e->getMessage();
        }
        return $response;
    }
}