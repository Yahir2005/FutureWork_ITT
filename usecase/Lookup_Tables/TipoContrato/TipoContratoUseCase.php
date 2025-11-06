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
            $response ->message = "Empresa obtenidas correctamente";
        } catch (Exception $e)  {
            $response ->status = "Error";
            $response ->message = "Error al obtener las empresas: ".$e->getMessage();
        }
        return $response;
    }
}