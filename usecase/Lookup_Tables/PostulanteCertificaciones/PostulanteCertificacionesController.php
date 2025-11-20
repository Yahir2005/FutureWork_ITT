<?php
require_once __DIR__ ."/PostulanteCertificacionesGateway.php";
require_once __DIR__ ."/PostulanteCertificacionesUseCase.php";

class   PostulanteCertificacionesController {

    public function listarPostulanteCertificaciones():RespuestaGenerica {
        $gateway = new PostulanteCertificacionesGateway();
        $useCase = new PostulanteCertificacionesUseCase($gateway);
        $response = $useCase->listarPostulanteCertificaciones();
        return $response;
    }

}
$controller = new PostulanteCertificacionesController();
$result  = $controller->listarPostulanteCertificaciones();
echo $result->message;