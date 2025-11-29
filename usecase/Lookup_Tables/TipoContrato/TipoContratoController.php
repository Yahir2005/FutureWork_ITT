<?php
require_once __DIR__ ."/TipoContratoGateway.php";
require_once __DIR__ ."/TipoContratoUseCase.php";

class TipoContratoController{
    public function listarTipoContrato(): RespuestaGenerica {
        $gatewayDB = new TipoContratoGateway();
        $UseCase = new TipoContratoUseCase($gatewayDB);
        return $UseCase->listarTipoContrato();
    }

    public function listarTipoContratoPorId($id): RespuestaGenerica {
        $gatewayDB = new TipoContratoGateway();
        $UseCase = new TipoContratoUseCase($gatewayDB);
        return $UseCase->listarTipoContratoPorId($id);
    }
}
/*
$controller = new TipoContratoController();
$result = $controller->listarTipoContratoPorId(1);
echo $result->message;
*/
/*
$controller = new TipoContratoController();
$response = $controller ->listarTipoContrato();
echo $response->message;
*/