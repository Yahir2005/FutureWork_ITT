<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenesPerfilEmpresaUseCase{
    private $gatewayDb;

    public function __construct(IImagenesPerfilEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->InsertarImagenPerfilEmpresa($imagenPerfilEmpresa);
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha insertado correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al insertar la imagen.".$e->getMessage();
        }
        return $response;
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->eliminarImagen($id);
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha eliminado correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al eliminar la imagen.".$e->getMessage();
        }
        return $response;
    }

    public function obtenerImagenes($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->obtenerImagenes($id);
            $response->status= "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se ha obtenido correctamente la imagen del perfil ";
        } catch (Throwable $e) {
            $response->status = "ERROR";
            $response->message = "Error al obtener la imagen.".$e->getMessage();
        }
        return $response;
    }

    public function perfilEmpresa($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->perfilEmpresa($id);
            $response->status = "ok";
            $response->body = $respuestaMetodo ;
            $response->message = "Se listaron correctamente los datos del perfil";
        } catch (Throwable $e) {
            $response->status = "error";
            $response->message = "Error al listar datos del perfil".$e->getMessage();
        }
        return $response;
    }

}