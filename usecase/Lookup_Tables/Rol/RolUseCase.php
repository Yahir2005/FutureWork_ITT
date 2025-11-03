<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class RolUseCase{

    private $gatewayDb;

    public function __construct(IRolGateway $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }
    public function ListarRoles(): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarRoles();
        try {
            $response -> status = "OK";
            $response -> body = $respuestaMetodo;
            $response -> message = "Roles obtenidos correctamente";

        } catch (Exception $e) {
            $response -> status = "ERROR";
            $response -> body = null;
            $response -> message = "Error al obtener roles: " . $e->getMessage();
        }
        return $response;
    }

    public function ListarRolPorId($idRol): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarRolPorId($idRol);
        try {
            $response -> status = "OK";
            $response -> body = $respuestaMetodo;
            $response -> message = "Rol obtenido correctamente";

        } catch (Exception $e) {
            $response -> status = "ERROR";
            $response -> body = null;
            $response -> message = "Error al obtener rol: " . $e->getMessage();
        }
        return $response;
    }
}