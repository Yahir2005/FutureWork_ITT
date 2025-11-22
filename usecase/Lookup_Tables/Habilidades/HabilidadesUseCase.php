<?php
require_once __DIR__ . '/IHabilidades.php';
require_once __DIR__ . '/HabilidadesGateway.php';
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class HabilidadesUseCase{
    private $gatewayDb;

    public function __construct(IHabilidades $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarHabilidades(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarHabilidades();
        try {
            $respose ->status = "ok";
            $respose ->body = $respuestaMetodo;
            $respose ->message = "Estado Habilidades Listados Correctamente";
        } catch (Exception $e) {
            $respose ->status = "ERROR";
            $respose ->message = "ERROR AL ENTABLAR HABILIDADES". $e ->getMessage();
        }
        return $respose;
    }



}

