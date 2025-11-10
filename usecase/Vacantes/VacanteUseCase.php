<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class VacanteUseCase{
    private $gatewayDb;

    public function __construct(IVacante $gatewayDb) {
        $this->gatewayDb = $gatewayDb;

    }

    Public function InsertarVacante(Vacantes $vacantes):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarVacante($vacantes);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacante insertada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar vacante: ". $e->getMessage();
        }
        return $response;
    }

}