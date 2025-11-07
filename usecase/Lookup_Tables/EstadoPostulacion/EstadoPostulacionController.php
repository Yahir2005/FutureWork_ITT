<?php
require_once __DIR__ ."/EstadoPostulacionGateway.php";
require_once __DIR__ ."/EstadoPostulacionUseCase.php";
require_once __DIR__ . "/../../../Dto/EstadoPostulacion.php";

class EstadoPostulacionController{

     public function listarEstadoPostulacion(): RespuestaGenerica{
        $gateway = new EstadoPostulacionGateway();
        $useCase = new EstadoPostulacionUseCase($gateway);
        return $useCase-> listarEstadoPostulacion();
     }
}
$controller = new EstadoPostulacionController();
$response = $controller-> listarEstadoPostulacion();
echo $response-> message;