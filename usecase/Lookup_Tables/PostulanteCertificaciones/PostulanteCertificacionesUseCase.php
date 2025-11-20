<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class PostulanteCertificacionesUseCase{
    private $gatewayDb;

    public function __construct(IPostulanteCertificaciones $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarPostulanteCertificaciones(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarPostulanteCertificaciones();
        try {
            $respose ->status = "ok";
            $respose ->body = $respuestaMetodo;
            $respose ->message = "Postulante Certificaciones Listados Correctamente";
        } catch (Exception $e) {
            $respose ->status = "ERROR";
            $respose ->message = "ERROR AL ENTABLAR CERTIFICACIONES". $e ->getMessage();
        }
        return $respose;
    }

}