<?php
require_once __DIR__ . "/IHabilidades.php";
require_once __DIR__ . "/HabilidadesGateway.php";
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

    public function InsertarHabilidades(Habilidades $habilidades):RespuestaGenerica{
            $response = new RespuestaGenerica(); 
        $respuestaMetodo = $this->gatewayDb->InsertarHabilidades($habilidades);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Tabla Habilidades insertado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar Habilidades: ". $e->getMessage();
        }
        return $response;
    }
}

