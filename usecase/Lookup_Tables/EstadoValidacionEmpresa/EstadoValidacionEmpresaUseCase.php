<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoValidacionEmpresaUseCase{

    private $gatewayDb;

    public function __construct(IEstadoValidacionEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

    public function ListarValidacionesEmpresa():RespuestaGenerica{
        $response = new RespuestaGenerica();
        $responseMetodo = $this->gatewayDb->ListarValidacionesEmpresa();
        try {
            $response ->status = "OK";
            $response  ->body = $responseMetodo;
            $response ->message = "Validaciones estado Empresa obtenidas correctamente";
        } catch (Exception $e) {
            $response ->status = "ERROR";
            $response ->message = "Error al obtener las validaciones estado Empresa:" . $e->getMessage();
        }
        return $response;
    }

    public function ListarValidacionesEmpresaId($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $responseMetodo = $this->gatewayDb->ListarValidacionesEmpresaId($id);
        try {
            $response ->status = "OK";
            $response  ->body = $responseMetodo;
            $response ->message = "Validaciones estado Empresa por id obtenidas correctamente";
        } catch (Exception $e) {
            $response ->status = "ERROR";
            $response ->message = "Error al obtener las validaciones estado Empresa por id:" . $e->getMessage();
        }
        return $response;
    }
}

/**
 * comandos git hub
 * * git add .  // cargar archivos 
 * * git commit -m "mensaje" // mensaje de los cambios o commit
 * * git push origin main // subir los cambios a github
 * 
 */