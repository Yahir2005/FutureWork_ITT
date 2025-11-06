<?php
require_once __DIR__ ."/PostulacionesGateway.php";
require_once __DIR__ ."/PostulacionesUseCase.php";
require_once __DIR__ ."/../../Dto/Postulaciones.php";
class PostulacionesController{
    public function InsertarPostulacion(Postulaciones $postulacion):RespuestaGenerica{
        $gateway = new PostulacionesGateway();
        $useCase = new PostulacionesUseCase($gateway);
        return $useCase->InsertarPostulacion($postulacion);
    }
}
/*
$controller = new PostulacionesController();
$postulacion = new Postulaciones();
$postulacion->set("Postulante_idPostulante", 1);
$postulacion->set("Vacante_idVacante", 1);
$postulacion->set("EstadoPostulacion_idEstadoPostulacion", 1);
$postulacion->set("fechaPostulacion", date("Y-m-d H:i:s"));
$response = $controller->InsertarPostulacion($postulacion);
echo $response->message;
*/