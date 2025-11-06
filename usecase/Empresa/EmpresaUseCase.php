<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class EmpresaUseCase{
    private $gatewayDb;

    public function __construct(IEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function listarEmpresas(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarEmpresas();
        try {
            $response ->status = "Ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Empresas obtenidas correctamente";
        } catch (Exception $e) {
            $response ->status = "Error";
            $response ->message = "Error al obtener las empresas: ".$e->getMessage();
        }
        return $response;
    }
} 