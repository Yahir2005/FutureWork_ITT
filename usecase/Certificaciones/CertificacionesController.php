<?php
require_once __DIR__ ."/CertificacionesGatawey.php";
require_once __DIR__ ."/CertificacionesUseCase.php";
require_once __DIR__ ."/../../Dto/Certificaciones.php";

class CertificacionesController{
    public function insertarCertificacion(Certificaciones $certificaciones):RespuestaGenerica{
        $gatewayDb = new CertificacionesGatawey();
        $UseCase = new CertificacionesUseCase($gatewayDb);
        return $UseCase->insertarCertificacion($certificaciones);
    }
}
/*
$controller = new CertificacionesController();
$objCertificacion = new Certificaciones();
$objCertificacion->set("nombre","adsasd");
$objCertificacion->set("organizacionEmisora","dassa");
$objCertificacion->set("fechaObtencion","2023-10-29");
$objCertificacion->set("urlCredencial","asdsa");
$result = $controller->insertarCertificacion($objCertificacion);
echo $result->message;
*/