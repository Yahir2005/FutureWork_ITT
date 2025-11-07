<?php
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";
class PostulanteUseCase{
 private $gatewayDb;

public function __construct(IPostulante $gatewayDb) {
    $this->gatewayDb = $gatewayDb;
  }

  public function listarPostulacion (): RespuestaGenerica{
    $response =new RespuestaGenerica();
    $respuestaMetodo=$this->gatewayDb->listarPostulacion();
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