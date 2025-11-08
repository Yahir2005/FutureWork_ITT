<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.phps";

class ImagenesPerfilPostulanteUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPerfilPostulante $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->InsertarImagenPerfilPostulante($imagenesPerfilPostulante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se ha insertado correctamente la imagen del perfil ";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen" .$e->getMessage();
        }
        return $response;
    }
}