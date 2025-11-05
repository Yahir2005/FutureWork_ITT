<?php
require_once __DIR__ ."/EstadoValidacionEmpresaGateway.php";
require_once __DIR__ ."/EstadoValidacionEmpresaUseCase.php";

class EstadoValidacionEmpresaController {

    public function ListarValidacionesEmpresa():RespuestaGenerica {  
        $gateway = new EstadoValidacionEmpresaGateway();
        $useCase = new EstadoValidacionEmpresaUseCase($gateway);
        $response = $useCase->ListarValidacionesEmpresa();
        return $response;
    }

     public function ListarValidacionesEmpresaId($id){
        $gateway = new EstadoValidacionEmpresaGateway();
        $useCase = new EstadoValidacionEmpresaUseCase($gateway);
        $response = $useCase->ListarValidacionesEmpresaId($id);
        return $response;
     }

}

/* Listar*/
/*
$controller = new EstadoValidacionEmpresaController();
$response = $controller->ListarValidacionesEmpresa();
echo $response->message;*/

/* Listar por id*/
/*
$controller = new EstadoValidacionEmpresaController();
$response = $controller->ListarValidacionesEmpresaId(1);
echo $response->message;
*/