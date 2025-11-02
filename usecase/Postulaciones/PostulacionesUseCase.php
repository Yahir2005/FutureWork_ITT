<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
require_once __DIR__ ."/IPostulacionGateway.php";

class PostulacionesUseCase{
    private $gatewayDb;
    public function __construct(IPostulacionGateway $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }
    
    public function InsertarPostulacion(Postulaciones $postulacion):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $response->status = "ok";
            $response->body = $this->gatewayDb->InsertarPostulacion($postulacion);
            $response->message = "Se inserto el precio";
        } catch (Exception $e) {
            $response->status = "error";
            $response->body = null;
            $response->message = "Error al insertar precio".$e->getMessage();
        }
        return $response;
    }
    
}