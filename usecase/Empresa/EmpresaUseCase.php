<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class EmpresaUseCase{
    private $gatewayDb;

    public function __construct(IEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function listarEmpresas(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarEmpresas();
        try {
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Empresas obtenidas correctamente";
        } catch (Exception $e) {
            $response ->status = "Error";
            $response ->message = "Error al obtener las empresas: ".$e->getMessage();
        }
        return $response;
    }

    public function insertarEmpresas(Empresa $empresa): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->insertarEmpresas($empresa);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa insertada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar la empresa: " . $e->getMessage();
        }
        return $response;
    }

    public function actualizarEmpresas($id, $empresa): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->actualizarEmpresas($id, $empresa);
        try {
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar la empresa: " . $e->getMessage();
        }
        return $response;
    }

    public function eliminarEmpresas($id): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDb->eliminarEmpresas($id);
            $response->status = "Ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa eliminada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al eliminar la empresa: " . $e->getMessage();
        }
        return $response;
    }

    public function buscarEmpresasPorNombre($Nombre): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->buscarEmpresasPorNombre($Nombre);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresas encontradas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al buscar las empresas: " . $e->getMessage();
        }
        return $response;
    }

    public function buscarEmpresasPorSector($Sector): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->buscarEmpresasPorSector($Sector);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Empresa encontrada por sector correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al buscar Empresas". $e->getMessage();
        }
        return $response;
    }

    public function buscarEmpresasPorTipoEstado($Tipo): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->buscarEmpresasPorTipoEstado($Tipo);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se encontro el estado de la empresa Correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al encontrar el estado de la empresa". $e->getMessage();
        }
        return $response;
    }

    public function actualizarEstadoEmpresa($id,$empresa): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->actualizarEstadoEmpresa($id,$empresa);
        try {
            $response-> status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se actualizo el estado de la empresa Correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "No se pudo actualizar el estado de la empresa". $e->getMessage();
        }
        return $response;
    }

    public function obtenerEmpresaPorIdUsuario($id):RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->obtenerEmpresaPorIdUsuario($id);
        try {
            $response-> status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se obtuvo la empresa por ID de usuario correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "No se pudo obtener la empresa por ID de usuario". $e->getMessage();
        }
        return $response;
    }

    public function contarEmpresasPorValidacion($id): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->contarEmpresasPorValidacion($id);
        try {
            $response-> status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Se conto el numero de empresas por validacion correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "No se pudo contar el numero de empresas por validacion". $e->getMessage();
        }
        return $response;
    }
    
} 