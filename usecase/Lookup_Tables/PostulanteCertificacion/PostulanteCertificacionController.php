<?php
require_once __DIR__ ."/PostulanteCertificacionGateway.php";
require_once __DIR__ ."/PostulanteCertificacionUseCase.php";
require_once __DIR__ ."/IPostulanteCertificacion.php";

class   PostulanteCertificacionController {

    public function listarPostulanteCertificacion():RespuestaGenerica {
        $gatewayDb = new PostulanteCertificacionGateway();
        $useCase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $useCase->listarPostulanteCertificacion();
        return $response;
    }
    public function InsertarPostulanteCertificacion( $postulanteCertificacion):RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->InsertarPostulanteCertificacion($postulanteCertificacion);
        return $response;
    }
    
    public function ActualizarPostulanteCertificacion($id, $postulanteCertificacion):RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->ActualizarPostulanteCertificacion($id, $postulanteCertificacion);
        return $response;
    }

    public function EliminarPostulanteCertificacion($id): RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->EliminarPostulanteCertificacion($id);
        return $response;
    }

}
/*$controller = new PostulanteCertificacionController();
$result  = $controller->listarPostulanteCertificacion();
echo $result->message;*/