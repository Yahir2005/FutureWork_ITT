<?php
require_once __DIR__ ."/EstadoValidacionVacanteGateway.php";
require_once __DIR__ ."/EstadoValidacionVacanteUseCase.php";

class EstadoValidacionVacanteController{
    public function ListarEstadoValidacionVacante(): RespuestaGenerica {
        $gatewayDB = new EstadoValidacionVacanteUseCaseGateway();
        $UseCase = new EstadoValidacionVacanteUseCase($gatewayDB);
        return $UseCase->ListarEstadoValidacionVacante();
    }

    public function ListarEstadoValidacionVacantePorId($idEstado): RespuestaGenerica {
        $gatewayDB = new EstadoValidacionVacanteUseCaseGateway();
        $UseCase = new EstadoValidacionVacanteUseCase($gatewayDB);
        return $UseCase->ListarEstadoValidacionVacantePorId($idEstado);
    }
}
/*
$controller = new EstadoValidacionVacanteController();
$response = $controller->ListarEstadoValidacionVacante();
echo $response->message;*/
/*
$controller = new EstadoValidacionVacanteController();
$response = $controller->ListarEstadoValidacionVacantePorId(1);
echo $response->message;
*/