<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class PostulacionesUseCase{
    private $gatewayDb;
    public function __construct(IPostulaciones $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }
    
    public function InsertarPostulacion(Postulaciones $postulacion):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $response->status = "ok";
            $response->body = $this->gatewayDb->InsertarPostulacion($postulacion);
            $response->message = "Se inserto la postulacion";
        } catch (Exception $e) {
            $response->status = "error";
            $response->body = null;
            $response->message = "Error al insertar la postulacion".$e->getMessage();
        }
        return $response;
    }


        public function ListarPostulacionesPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarPostulacionesPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulaciones listadas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al listar postulaciones: ". $e->getMessage();
        }
        return $response;
    }


        public function contartotalPostulacionesPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contartotalPostulacionesPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  postulaciones abiertas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar postulaciones abiertas". $e->getMessage();
        }
        return $response;
    }

        
        public function contartotalRevisionPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contartotalRevisionPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  postulaciones abiertas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar postulaciones abiertas". $e->getMessage();
        }
        return $response;
    }



            public function contartotalAceptadasPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contartotalAceptadasPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  postulaciones abiertas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar postulaciones abiertas". $e->getMessage();
        }
        return $response;
    }



            public function contartotalEntrevistaProgramadaPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contartotalEntrevistaProgramadaPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  postulaciones abiertas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar postulaciones abiertas". $e->getMessage();
        }
        return $response;
    }

    
}