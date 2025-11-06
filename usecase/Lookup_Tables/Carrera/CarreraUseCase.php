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
        $response-> message="Empresas obtenidas correctamente";

    } catch (Exception $e) {
        $response->status ="Error";
        $response->message="Error al obtener a las empresas: " .$e->getMessage();
    }
    return $response;
  }
  
}