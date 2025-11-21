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
}