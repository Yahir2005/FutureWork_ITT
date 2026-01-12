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

    public function ContarCandidatosPorVacante($idVacante):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ContarCandidatosPorVacante($idVacante);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar candidatos Vacantes correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar candidatos Vacantes ". $e->getMessage();
        }
        return $response;
    }

    public function contarVacantes():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantes();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar candidatos Vacantes correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar candidatos Vacantes ". $e->getMessage();
        }
        return $response;
    }



        public function contarVacantesAbiertas():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesAbiertas();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  Vacantes abiertas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar vacantes abiertas". $e->getMessage();
        }
        return $response;
    }

            public function contarVacantesCerradas():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesCerradas();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  Vacantes cerradas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar vacantes cerradas". $e->getMessage();
        }
        return $response;
    }

                public function contarVacantesPausadas():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesPausadas();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Contar  Vacantes Pausadas";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al contar vacantes pausadas". $e->getMessage();
        }
        return $response;
    }

    public function ListarVacantesTotalesCard():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarVacantesTotalesCard();
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
    public function contarVacantesAbiertasPorEmpresa($idEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesAbiertasPorEmpresa($idEmpresa);
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

    public function contarVacantesCerradasPorEmpresa($idEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesCerradasPorEmpresa($idEmpresa);
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

    public function contarVacantesPausadasPorEmpresa($idEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarVacantesPausadasPorEmpresa($idEmpresa);
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

}