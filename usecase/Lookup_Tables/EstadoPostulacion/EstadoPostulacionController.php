<?php
require_once __DIR__ ."/EstadoPostulacionGateway.php";
require_once __DIR__ ."/EstadoPostulacionUseCase.php";
require_once __DIR__ ."/../../../Dto/EstadoPostulacion.php";
require_once __DIR__ ."/IEstadoPostulacion.php";

class   EstadoPostulacionController {

    public function listarEstadoPostulacion():RespuestaGenerica{
        $gatewayDb = new EstadoPostulacionGateway();
        $usecase = new EstadoPostulacionUseCase($gatewayDb);
        return $usecase-> listarEstadoPostulacion();
     }

    public function listarEstadoPostulacionPorId($idEstadoPostulacion):RespuestaGenerica{
        $gatewayDb = new EstadoPostulacionGateway();
        $usecase = new EstadoPostulacionUseCase($gatewayDb);
        return $usecase-> listarEstadoPostulacionPorId($idEstadoPostulacion);
     }

}

/*$controller = new EstadoPostulacionController();
$response = $controller->listarEstadoPostulacion();
echo $response-> message;

$controller = new EstadoPostulacionController();
$response = $controller->listarEstadoPostulacionPorId($idEstadoPostulacion);
echo $response-> message;*/