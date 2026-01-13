<?php
require_once __DIR__ . "/PostulantesUseCase.php";
require_once __DIR__ . "/PostulanteGateway.php";
require_once __DIR__ . "/../../Dto/Postulante.php";
require_once __DIR__ . "/../../Dto/RespuestaGenerica.php";
require_once __DIR__ . "/PostulantesUseCase.php";
require_once __DIR__ . "/PostulanteGateway.php";

class PostulantesController {
    
    public function InsertarPostulante(Postulante $postulante): RespuestaGenerica {
        $gatewayDb = new PostulanteGateway();
        $useCase = new PostulantesUseCase($gatewayDb);
        return $useCase->InsertarPostulante($postulante);
    }

    public function ListarPostulantes(): RespuestaGenerica {
        $gatewayDb = new PostulanteGateway();
        $useCase = new PostulantesUseCase($gatewayDb);
        return $useCase->ListarPostulantes();
    }

    public function obtenerPostulantePorIdUsuario($idUsuario): RespuestaGenerica {
    $gatewayDb = new PostulanteGateway();
    $useCase = new PostulantesUseCase($gatewayDb);
    return $useCase->obtenerPostulantePorIdUsuario($idUsuario);
    }

    public function ActualizarPostulante($id, Postulante $postulante): RespuestaGenerica {
        $gatewayDb = new PostulanteGateway();
        $useCase = new PostulantesUseCase($gatewayDb);
        return $useCase->ActualizarPostulante($id, $postulante);
    }

    public function EliminarPostulante($id): RespuestaGenerica {
        $gatewayDb = new PostulanteGateway();
        $useCase = new PostulantesUseCase($gatewayDb);
        return $useCase->EliminarPostulante($id);
    }
}
/*
$controller = new  PostulantesController();
$postulante = new Postulante();
$postulante->set("Carrera_idCarrera",1);
$postulante->set("Usuarios_idUsuarios",15);
$postulante->set("numeroControl","23360923");
$postulante->set("cvPath","/ruta/1");
$postulante->set("telefono","234432432");
$postulante->set("ubicacion","tehuacan");
$result = $controller->InsertarPostulante($postulante);
echo $result->body;
*/