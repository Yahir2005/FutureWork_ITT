<?php
require_once __DIR__ ."/PostulanteGateway.php";
require_once __DIR__ ."/PostulanteUseCase.php";

class PostulanteController {

    public function listarPostulante():RespuestaGenerica {  
        $gateway = new PostulanteGateway();
        $useCase = new PostulanteUseCase($gateway);
        $response = $useCase->listarPostulacion();
        return $response;
    }
}