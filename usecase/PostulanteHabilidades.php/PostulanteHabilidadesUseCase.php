<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class PostulanteHabilidadesUseCase{
private $gatewayDb;
        public function __construct(IPostulanteHabilidades $gatewayDb) {
        $this->gatewayDb = $gatewayDb;

    }
      public function insertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):RespuestaGenerica{
            $response = new RespuestaGenerica(); 
        $respuestaMetodo = $this->gatewayDb->insertarPostulanteHabilidades($postulanteHabilidades);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Habilidades insertado correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al insertar Postulante Habilidades: ". $e->getMessage();
        }
        return $response;
    }
    
}