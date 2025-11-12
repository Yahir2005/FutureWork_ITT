<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";
class CarreraUseCase{
 private $gatewayDb;

public function __construct(ICarrera $gatewayDb) {
    $this->gatewayDb = $gatewayDb;
  }

  public function listarCarrera (): RespuestaGenerica{
    $response =new RespuestaGenerica();
    $respuestaMetodo=$this->gatewayDb->listarCarrera();
    try {
        $response-> status ="OK";
        $response-> body =$respuestaMetodo;
        $response-> message="Carrera obtenidas correctamente";

    } catch (Exception $e) {
        $response->status ="Error";
        $response->message="Error al obtener a las carreras: " .$e->getMessage();
    }
    return $response;
  }

    public function listarCarreraPorId($idCarrera): RespuestaGenerica {
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->listarCarreraPorId($idCarrera);
        try {
            $response -> status = "OK";
            $response -> body = $respuestaMetodo;
            $response -> message = "carrera obtenido correctamente";

        } catch (Exception $e) {
            $response -> status = "ERROR";
            $response -> body = null;
            $response -> message = "Error al obtener Carrera: " . $e->getMessage();
        }
        return $response;
    }
  
}