<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";

class VacanteUseCase{
    private $gatewayDb;

    public function __construct(IVacante $gatewayDb) {
        $this->gatewayDb = $gatewayDb;

    }

    Public function InsertarVacante(Vacantes $vacantes):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarVacante($vacantes);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacante insertada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar vacante: ". $e->getMessage();
        }
        return $response;
    }

    public function ActualizarVacante($id, $vacantes):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ActualizarVacante($id, $vacantes);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacante actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar vacante: ". $e->getMessage();
        }
        return $response;
    }

    public function EliminarVacante($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->EliminarVacante($id);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacante eliminada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al eliminar vacante: ". $e->getMessage();
        }
        return $response;
    }

    public function ListarVacantes():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarVacantes();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacantes listadas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al listar vacantes: ". $e->getMessage();
        }
        return $response;
    }

    public function ListarVacantesPorNombre($nombre):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarVacantesPorNombre($nombre);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacantes listadas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al listar vacantes: ". $e->getMessage();
        }
        return $response;
    }

    public function ListarVacantesPorEmpresa($idEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarVacantesPorEmpresa($idEmpresa);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacantes listadas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al listar vacantes: ". $e->getMessage();
        }
        return $response;
    }

    public function ListarVacantesPorEstadoEmpresaContrato($idEstado):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarVacantesPorEstadoEmpresaContrato($idEstado);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Vacantes Listadas Por Empresa y contrato Correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al listar Vacantes Por Empresa y contrato Correctamente". $e->getMessage();
        }
        return $response;
    }
}