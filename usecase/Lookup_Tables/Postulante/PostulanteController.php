<?php
require_once __DIR__ ."/PostulanteGateway.php";
require_once __DIR__ ."/PostulanteUseCase.php";
require_once __DIR__ ."/../../../Dto/Postulante.php";

class PostulanteController {
public function listarPostulante (): RespuestaGenerica{
    $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        return $useCase->listarPostulante();
    }

}
/*$controller = new PostulanteController();
$response = $controller -> listarPostulante();
echo $response-> message; */


