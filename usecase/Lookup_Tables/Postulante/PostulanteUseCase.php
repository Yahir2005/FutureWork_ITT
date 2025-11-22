<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";
class PostulanteUseCase{
    private $gatewayDb;
    public function __construct(IPostulante $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }
    public function listarPostulante (): RespuestaGenerica{
    $response = new RespuestaGenerica();
    $respuestaMetodo = $this->gatewayDb->listarPostulante ();
        try {
            $response ->status = "Ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Postulante obtenido correctamente";
        } catch (Exception $e) {
            $response ->status = "Error";
            $response ->message = "Error al obtener Postulante: ".$e->getMessage();
        }
        return $response;
    }
    
     public function insertarPostulante (Postulante $postulante):RespuestaGenerica{
      $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarPostulante($postulante);
        try {
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante insertado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar postulante: " . $e->getMessage();
        }
        return $response;
    }
    
     public function actualizarPostulante ($id, $postulante):RespuestaGenerica{
      $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->actualizarPostulante($id, $postulante);
        try {
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante actualizado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar postulante: " . $e->getMessage();
        }
        return $response;
    }
     public function eliminarPostulante ($id): RespuestaGenerica{
          $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->eliminarPostulante($id);
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante eliminado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al eliminar postulante: " . $e->getMessage();
        }
        return $response;
    }

    public function listarPostulantePorNombre($Nombre): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $responseMetodo = $this->gatewayDb->listarPostulantePorNombre($Nombre);
        try {
            $response->status = "ok";
            $response->body = $responseMetodo;
            $response->message = "Exito al listar los postulantes por nombre";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al listar los postulante por nombre". $e->getMessage();
        }
        return $response;
    }
}