<?php
require_once __DIR__ ."/CarreraGateway.php";
require_once __DIR__ ."/CarreraUseCase.php";

class CarreraController{
    public function listarCarrera(): RespuestaGenerica {
        $gatewayDB = new CarreraGateway();
        $UseCase = new CarreraUseCase($gatewayDB);
        return $UseCase->listarCarrera();
    }
    }
$controller=new CarreraController();
$$response =$contrroller ->listarCarrera();
echo $response-> message;