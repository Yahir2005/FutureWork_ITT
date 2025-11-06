<?php
require_once __DIR__ ."/../../../RespuestaGenerica.php";
class CarreraUseCase{
 private $gatewayDb;

public function __construct(ICarrera $gatewayDb) {
    $this-> gatwayDb = $gatewayDb;
  }

  public function listarCarrera (): RespuesaGenerica{
    $response =new RespuestaGenerica()
    $respuestaMetodo=$this->gatwayDb->listarCarrera();
    try {
        $respense-> status ="OK";
        $respense-> body =$respuestaMetodo;
        $respense-> mesage="Empresas obtenidas correctamente";

    } catch (Exception $e) {
        $respense->status ="Error";
        $respense->message="Error al obtener a las empresas: " .$e->getmessage();
    }
    return $respense;
  }
}