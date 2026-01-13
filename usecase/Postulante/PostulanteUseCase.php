<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class PostulanteUseCase
{
    private $gatewayDb;

    public function __construct(IPostulante $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

 public function insertarPostulante(Postulante $postulante): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarPostulante($postulante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante insertada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar el: " . $e->getMessage();
        }
        return $response;
    }
      public function obtenerPostulantePorIdUsuario($id):RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->obtenerPostulantePorIdUsuario($id);
        try {
            $response-> status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se obtuvo el postulante por ID de usuario correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "No se pudo obtener la postulante por ID de usuario". $e->getMessage();
        }
        return $response;
    }

      public function actualizarPostulante($id, $postulante): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->actualizarPostulante($id, $postulante);
        try {
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar la empresa: " . $e->getMessage();
        }
        return $response;
    }
    /* public function actualizarCV($idPostulante, $postulante): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->actualizarPostulante($idPostulante, $postulante);
        try {
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar la empresa: " . $e->getMessage();
        }
        return $response;
    }*/
   public function listarPostulantes(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarPostulantes();
        try {
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Postulantes obtenido correctamente";
        } catch (Exception $e) {
            $response ->status = "Error";
            $response ->message = "Error al obtener los Postulantes: ".$e->getMessage();
        }
        return $response;
    }


}