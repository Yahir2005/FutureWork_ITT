<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class PostulanteHabilidadesUseCase{
private $gatewayDb;
        public function __construct(IVacante $gatewayDb) {
        $this->gatewayDb = $gatewayDb;

    }
      public function InsertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):RespuestaGenerica{
            $response = new RespuestaGenerica(); 
        $respuestaMetodo = $this->gatewayDb->InsertarPostulanteHabilidades($postulanteHabilidades);
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
    public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ActualizarPostulanteHabilidades($id, $postulanteHabilidades);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Habiliidades actualizada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al actualizar Postulante Habilidades: ". $e->getMessage();
        }
        return $response;
    }
    public function EliminarPostulanteHabilidades($id):RespuestaGenerica{
         $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->EliminarPostulanteHabilidades($id);
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Habilidades eliminada correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al eliminar Postulante Habilidades: ". $e->getMessage();
        }
        return $response;
    }
    public function ListarPostulanteHabilidades():RespuestaGenerica{
          $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDb->ListarPostulanteHabilidades();
        try {
            $response->status = "ok";
            $response->body = $respuestaMetodo;
            $response->message = "Postulante Habilidades listadas correctamente";
        } catch (Exception $e) {
            $response->status = "Error";
            $response->message = "Error al listar Posrulante Habilidades: ". $e->getMessage();
        }
        return $response;
    }
}