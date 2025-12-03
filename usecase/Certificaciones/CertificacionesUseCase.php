<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class CertificacionesUseCase{
    private $gatewayDb;

    public function __construct(ICertificaciones $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }

    public function insertarCertificacion(Certificaciones $certificaciones):RespuestaGenerica{
        $response =new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarCertificacion($certificaciones);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se inserto correctamente la certificacion";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->body = "Error al insertar Certificacion".$e->getMessage();
        }
        return $response;
    }
}