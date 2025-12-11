<?php
require_once __DIR__ ."/IPostulanteCertificacion.php";
require_once __DIR__ ."/PostulanteCertificacionGateway.php";
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class PostulanteCertificacionUseCase{
    private $gatewayDb;

    public function __construct(IPostulanteCertificacion $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function ListarPostulanteCertificacion(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->ListarPostulanteCertificacion();
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
    public function InsertarPostulanteCertificacion(PostulanteCertificacion $postulanteCertificacion):RespuestaGenerica{
        $response = new RespuestaGenerica(); 
        $respuestaMetodo = $this->gatewayDb->InsertarPostulanteCertificacion($postulanteCertificacion);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Certificacion insertado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar Postulante Certificacion: ". $e->getMessage();
        }
        return $response;
    }

     public function ActualizarPostulanteCertificacion($id, $postulanteCertificacion):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ActualizarPostulanteCertificacion($id, $postulanteCertificacion);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "postulante certificado actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar Postulante Certificacion: ". $e->getMessage();
        }
        return $response;
    }

    public function EliminarPostulanteCertificacion($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->EliminarPostulanteCertificacion($id);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Certificacion eliminada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al eliminar Postulante Certificacion: ". $e->getMessage();
        }
        return $response;
    }

}