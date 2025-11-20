<?php
require_once __DIR__ ."/EstadoHbilidadesGateway.php";
require_once __DIR__ ."/EstadoHabilidadesUseCase.php";

class   EstadoHabilidadesController {

    public function listarEstadoHabilidades():RespuestaGenerica {  
        $gateway = new EstadoHabilidadesGateway();
        $useCase = new EstadoHabilidadesUseCase($gateway);
        $response = $useCase->listarEstadoHabilidades();
        return $response;
    }
}