<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPerfilPostulanteUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPerfilPostulante $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->InsertarImagenPerfilPostulante($imagenesPerfilPostulante);
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se ha insertado correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen" .$e->getMessage();
        }
        return $response;
    }

    public function EliminarImagenPerfilPostulante($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->EliminarImagenPerfilPostulante($id);
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se ha eliminado correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al eliminar la imagen" .$e->getMessage();
        }
        return $response;
    }

    public function MostrarImagenPerfilPostulante($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->MostrarImagenPerfilPostulante($id);
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se ha obtenido correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al obtener la imagen" .$e->getMessage();
        }
        return $response;
    }

    public function perfilPostulante($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->perfilPostulante($id);
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se listaron correctamente los datos del perfil";
        } catch (Throwable $e) {
            $response->status = "error";
            $response->message = "Error al listar correctamente los datos del perfil".$e->getMessage();
        }
        return $response;
    }
}