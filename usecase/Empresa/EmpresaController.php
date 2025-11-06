<?php
require_once __DIR__ ."/EmpresaGateway.php";
require_once __DIR__ ."/EmpresaUseCase.php";

class EmpresaController{
    public function listarEmpresas(): RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->listarEmpresas();
    }
}

$controller = new EmpresaController();
$response = $controller->listarEmpresas();
echo $response->message;
