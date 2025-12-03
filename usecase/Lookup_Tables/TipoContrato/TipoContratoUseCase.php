<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class TipoContratoUseCase{
    private $gatewayDB;

    public function __construct(ITipoContrato $gatewayDB){
        $this->gatewayDB = $gatewayDB;
    }

    public function listarTipoContrato(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDB-> listarTipoContrato();
        try{
            $response ->status = "Ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Tipos de contrato obtenidos correctamente";
        } catch (Exception $e)  {
            $response ->status = "Error";
            $response ->message = "Error al obtener los tipos de contrato: ".$e->getMessage();
        }
        return $response;
    }

    public function listarTipoContratoPorId($id): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $responseMetodo = $this ->gatewayDB->listarTipoContratoPorId($id);
        try {
            $response->status = "ok";
            $response ->body = $responseMetodo;
            $response ->message = "Se listo por id tipo contrato correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response ->message = "Error al listar por id tipo contrato".$e->getMessage();
        }
        return $response;
    }
}