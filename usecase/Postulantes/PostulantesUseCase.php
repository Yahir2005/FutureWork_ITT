<?php
require_once __DIR__ . "/../../Dto/RespuestaGenerica.php";

class PostulantesUseCase {
    private $gatewayDb;

    public function __construct(IPostulantes $gatewayDb) {
        $this->gatewayDb = $gatewayDb;
    }

    public function InsertarPostulante(Postulante $postulante): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            // CORRECCIÓN: Llamar al gateway, no a sí mismo
            $respuestaMetodo = $this->gatewayDb->InsertarPostulante($postulante);
            
            if($respuestaMetodo > 0){
                $response->status = "ok";
                $response->body = $respuestaMetodo; // ID del nuevo registro
                $response->message = "Se insertó correctamente el Postulante";
            } else {
                $response->status = "error";
                $response->message = "No se pudo insertar en la BD";
            }
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al insertar postulante: " . $e->getMessage();
        }
        return $response;
    }

    public function ListarPostulantes(): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            $data = $this->gatewayDb->ListarPostulantes();
            $response->status = "ok";
            $response->body = $data;
            $response->message = "Listado obtenido correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al listar: " . $e->getMessage();
        }
        return $response;
    }

    public function ActualizarPostulante($id, Postulante $postulante): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            $result = $this->gatewayDb->ActualizarPostulante($id, $postulante);
            $response->status = "ok";
            $response->body = $result;
            $response->message = "Postulante actualizado correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al actualizar: " . $e->getMessage();
        }
        return $response;
    }

    public function EliminarPostulante($id): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            $result = $this->gatewayDb->EliminarPostulante($id);
            $response->status = "ok";
            $response->body = $result;
            $response->message = "Postulante eliminado correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = "Error al eliminar: " . $e->getMessage();
        }
        return $response;
    }

        public function obtenerPostulantePorIdUsuario($idUsuario): RespuestaGenerica {
        $response = new RespuestaGenerica();

        if (!$idUsuario || !is_numeric($idUsuario)) {
            $response->status = "error";
            $response->message = "idUsuario inválido";
            $response->body = null;
            return $response;
        }

        return $this->gatewayDb->obtenerPostulantePorIdUsuario((int)$idUsuario);
    }


}