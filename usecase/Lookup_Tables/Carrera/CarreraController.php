<?php
require_once __DIR__ ."/CarreraGateway.php";
require_once __DIR__ ."/CarreraUseCase.php";

class CarreraController{
    public function listarCarrera(): RespuestaGenerica {
        $gatewayDB = new CarreraGateway();
        $UseCase = new CarreraUseCase($gatewayDB);
        return $UseCase->listarCarrera();
    }
     public function listarCarreraPorId($idCarrera): RespuestaGenerica{
        $gatewayDB= new CarreraGateway();
        $UseCase= new CarreraUseCase($gatewayDB);
        return $UseCase->listarCarreraPorId($idCarrera);
     }
}

$controller=new CarreraController();
$response =$controller ->listarCarrera();
echo $response-> message;
/*
 $controller = new CarreraController();
 $response = $controller ->listarCarreraPorId(1);
 echo $response ->message;
 */