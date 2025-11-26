<?php
require_once __DIR__ . "/IEstadoPostulacion.php";
require_once __DIR__ . "/EstadoPostulacionGateway.php";
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoPostulacionUseCase{
    private $gatewayDb;

    public function __construct(IEstadoPostulacion $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarEstadoPostulacion(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarEstadoPostulacion();
        try {
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Estado Postulaciones Listados Correctamente";
        } catch (Exception $e) {
            $response ->status = "ERROR";
            $response ->message = "ERROR AL LISTRAR". $e ->getMessage();
        }
        return $response;
    }

    public function listarEstadoPostulacionPorId($idEstadoPostulacion): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarEstadoPostulacionPorId($idEstadoPostulacion);
        try {
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Estado Postulacion Por Id Listados Correctamente";
        } catch (Exception $e) {
            $response ->status = "ERROR";
            $response ->message = "ERROR AL ENTABLAR Estado Postulacion Por Id". $e ->getMessage();
        }
        return $response;
    }

}