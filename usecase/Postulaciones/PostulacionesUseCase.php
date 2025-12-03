<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class PostulacionesUseCase{
    private $gatewayDb;
    public function __construct(IPostulaciones $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }
    
    public function InsertarPostulacion(Postulaciones $postulacion):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $response->status = "ok";
            $response->body = $this->gatewayDb->InsertarPostulacion($postulacion);
            $response->message = "Se inserto la postulacion";
        } catch (Exception $e) {
            $response->status = "error";
            $response->body = null;
            $response->message = "Error al insertar la postulacion".$e->getMessage();
        }
        return $response;
    }
    
}