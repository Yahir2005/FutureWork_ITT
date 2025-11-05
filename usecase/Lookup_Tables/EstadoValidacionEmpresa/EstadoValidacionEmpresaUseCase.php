<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoValidacionEmpresaUseCase{

    private $gatewayDb;

    public function __construct(IEstadoValidacionEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function ListarValidacionesEmpresa():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $responseMetodo = $this->gatewayDb->ListarValidacionesEmpresa();
        try {
            $response ->status = "OK";
            $response  ->body = $responseMetodo;
            $response ->message = "Validaciones estado Empresa obtenidas correctamente";
        } catch (Exception $e) {
            $reponse ->status = "ERROR";
        }
    }
}