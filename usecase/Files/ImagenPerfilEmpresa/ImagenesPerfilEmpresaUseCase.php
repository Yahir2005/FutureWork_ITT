<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPerfilEmpresaUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPerfilEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->InsertarImagenPerfilEmpresa($imagenPerfilEmpresa);
        try {
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha insertado correctamente la imagen del perfil ";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen.".$e->getMessage();
        }
        return $response;
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->eliminarImagen($id);
        try {
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha eliminado correctamente la imagen del perfil ";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al eliminar la imagen.".$e->getMessage();
        }
        return $response;
    }

    public function obtenerImagenes($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->obtenerImagenes($id);
        try {
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha obtenido correctamente la imagen del perfil ";
        } catch (Exception $e) {
            $response->status = "ERROR";
            $response->message = "Error al obtener la imagen.".$e->getMessage();
        }
        return $response;
    }
}