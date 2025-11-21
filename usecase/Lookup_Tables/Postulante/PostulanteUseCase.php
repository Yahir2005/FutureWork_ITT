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
    
    /*public function listarPostulantePorNombre ($Nombre):RespuestaGenerica{
    $response = new RespuestaGenerica ();
    $respuestaMetodo = $this -> gatewayDb->listarPostulantePorNombre ($Nombre);
    try {
        $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante encontrado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al buscar Postulante: " . $e->getMessage();
        }
        return $response;
    }*/
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
    
    
}