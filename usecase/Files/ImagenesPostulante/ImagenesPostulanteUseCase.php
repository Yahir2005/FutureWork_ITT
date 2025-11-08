<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPostulanteUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPostulante $gatewayDB){
        $this->gatewayDb = $gatewayDB;
    }

    public function obtenerImagenPostulante(ImagenesPostulante $imagenesPostulante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->obtenerImagenPostulante($imagenesPostulante);
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
}