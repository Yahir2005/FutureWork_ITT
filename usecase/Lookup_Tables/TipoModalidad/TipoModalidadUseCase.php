<?php
require_once __DIR__ . "/../../../Dto/RespuestaGenerica.php";
class TipoModalidadUseCase{
    private $gatewayDB;
    public function __construct(ITipoModalidad $gatewayDB){
        $this->gatewayDB = $gatewayDB;
    }

    public function listarTipoModalidad():RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $response->status = "ok";
            $response->body = $this->gatewayDB->listarTipoModalidad();
            $response->message = "Listado de tipos de modalidad obtenido correctamente.";
        } catch (Exception $e) {
            $response->status ="error";
            $response->message ="Error al obtener el listado de tipos de modalidad: ". $e->getMessage();
        }
        return $response;
    }
}