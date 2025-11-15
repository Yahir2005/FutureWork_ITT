<?php
require_once __DIR__ ."/PostulanteGateway.php";
require_once __DIR__ ."/PostulanteUseCase.php";
require_once __DIR__ ."/../../Dto/Postulante.php";

class PostulanteController {
public function listarPostulante (): RespuestaGenerica{
    $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->listarPostulante();
    }
public function insertarPostulante (Postulante $Postulante):RespuestaGenerica{
    $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->insertarPostulante($Postulante);
    }
 public function actualizarPostulante ($id, $Postulante):RespuestaGenerica{
     $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->actualizarPostulante($id, $Postulante);
    }
 public function eliminarPostulante ($id): RespuestaGenerica{
        $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->eliminarPostulante($id);
    }
 public function listarPostulantePorNombre($Nombre): RespuestaGenerica{ 
     $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->listarPostulantePorNombre($Nombre);
    }
}
$controller = new PostulanteController();
$response = $controller->listarPostulantePorNombre("Juan");
echo $response->message;