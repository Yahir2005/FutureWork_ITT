<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoHabilidadesUseCase{
    private $gatewayDb;

    public function __construct(IEstadoHabilidades $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarEstadoHabilidades(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarEstadoHabilidades();
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