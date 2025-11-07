<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoPostulacionUseCase{
    private $gatewayDb;

    public function __construct(IEstadoPostulacion $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarEstadoPostulacion(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarEstadoPostulacion();
        try {
            $respose ->status = "ok";
            $respose ->body = $respuestaMetodo;
            $respose ->message = "Estado Postulaciones Listados Correctamente";
        } catch (Exception $e) {
            $respose ->status = "ERROR";
            $respose ->message = "ERROR AL LISTRAR". $e ->getMessage();
        }
        return $respose;
    }

}