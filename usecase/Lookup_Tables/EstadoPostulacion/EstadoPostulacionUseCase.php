<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoPostulacionUseCase{
    private $gatewayDb;

    public function __construct(IEstadoPostulacion $gatewayDb)
    {
        $this ->gatewayDb = $gatewayDb;
    }

    public function listarEstadoPostulacion(): RespuestaGenerica{
        $respose = new RespuestaGenerica();
        $respuestaMetodo = $this ->gatewayDb ->listarEstadoPostulacion();
        try {
            $respose ->status = "ok";
            $respose ->body = $respuestaMetodo;
            $respose ->message = "Estado Postulaciones Listados Correctamente";
        } catch (Exception $e) {
            $respose ->status = "ERROR";
            $respose ->message = "ERROR AL LISTRAR". $e ->getMessage();
        }
        return $respose;
    }
    
    public function listarEstadoPostulacionId($id): RespuestaGenerica{
        $respose =  new RespuestaGenerica();
        $respuestaMetodo = $this -> gatewayDb -> listarEstadoPostulacion($id);
        try{
            $respose ->status = "ok";
            $respose ->body = $respuestaMetodo;
            $respose ->message = "Estado Postlaciones por ID ordenado correctamente";
        }catch(exception $e){
            $respose -> status = "ERROR";
            $respose ->message = "ERROR AL ORDDENAR POR ID". $e ->getMessage();
        }
        return $respose;
    }

     public function insertarEstadoPostulacion(array $body): RespuestaGenerica {
        $resp = new RespuestaGenerica();
        try {
            if (empty($body['nombre'])) throw new Exception("nombre requerido");
            $id = $this->gateway->insertarEstadoPostulacion($body);
            $resp->status = "ok";
            $resp->body = ['id' => $id];
            $resp->message = "Insertado correctamente";
        } catch (Exception $e) {
            $resp->status = "ERROR";
            $resp->message = "ERROR insertar: " . $e->getMessage();
        }
        return $resp;
    }

    public function actualizarEstadoPostulacion(int $id, array $body): RespuestaGenerica {
        $resp = new RespuestaGenerica();
        try {
            if (empty($body['nombre'])) throw new Exception("nombre requerido");
            $ok = $this->gateway->actualizarEstadoPostulacion($id, $body);
            $resp->status = $ok ? "ok" : "ERROR";
            $resp->message = $ok ? "Actualizado" : "No actualizado";
        } catch (Exception $e) {
            $resp->status = "ERROR";
            $resp->message = "ERROR actualizar: " . $e->getMessage();
        }
        return $resp;
    }

    public function eliminarEstadoPostulacion(int $id): RespuestaGenerica {
        $resp = new RespuestaGenerica();
        try {
            $ok = $this->gateway->eliminarEstadoPostulacion($id);
            $resp->status = $ok ? "ok" : "ERROR";
            $resp->message = $ok ? "Eliminado" : "No eliminado";
        } catch (Exception $e) {
            $resp->status = "ERROR";
            $resp->message = "ERROR eliminar: " . $e->getMessage();
        }
        return $resp;
    }

}