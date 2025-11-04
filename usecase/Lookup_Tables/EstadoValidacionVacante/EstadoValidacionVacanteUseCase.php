<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class EstadoValidacionVacanteUseCase{

    private $gatewayDB;

    public function __construct(IEstadoValidacionVacante $gatewayDB) {
        $this->gatewayDB = $gatewayDB;
    }

    public function ListarEstadoValidacionVacante(): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDB->ListarEstadoValidacionVacante();
        try {
            $response -> status = "OK";
            $response -> body = $respuestaMetodo;
            $response -> message = "Estados obtenidos correctamente";

        } catch (Exception $e) {
            $response -> status = "ERROR";
            $response -> body = null;
            $response -> message = "Error al obtener estados: " . $e->getMessage();
        }
        return $response;
    }

    public function ListarEstadoValidacionVacantePorId($idEstado): RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDB->ListarEstadoValidacionVacantePorId($idEstado);
        try {
            $response -> status = "OK";
            $response -> body = $respuestaMetodo;
            $response -> message = "Estado obtenido correctamente";

        } catch (Exception $e) {
            $response -> status = "ERROR";
            $response -> body = null;
            $response -> message = "Error al obtener estado: " . $e->getMessage();
        }
        return $response;
    }

}