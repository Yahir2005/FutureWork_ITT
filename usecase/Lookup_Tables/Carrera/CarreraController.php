<?php
require_once __DIR__ ."/CarreraGateway.php";
require_once __DIR__ ."/CarreraUseCase.php";

class CarreraController{
    public function ListarCarrera(): RespuestaGenerica {
        $gatewayDB = new CarreraGateway();
        $UseCase = new CarreraUseCase($gatewayDB);
        return $UseCase->ListarCarrera();
    }
    }
