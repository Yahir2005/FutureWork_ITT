<?php
require_once __DIR__ . "/TipoModalidadGateway.php";
require_once __DIR__ . "/TipoModalidadUseCase.php";

class TipoModalidadController{
    public function listarTipoModalidad():RespuestaGenerica{
        $gateway = new TipoModalidadGateway();
        $useCase = new TipoModalidadUseCase($gateway);
        return $useCase->listarTipoModalidad();
    }
}
/*
$controller = new TipoModalidadController();
$response = $controller->listarTipoModalidad();
echo $response->message;*/