<?php
require_once __DIR__ ."/PostulanteGateway.php";
require_once __DIR__ ."/PostulanteUseCase.php";
require_once __DIR__ ."/../../../Dto/Postulante.php";
class PostulanteController {
public function listarPostulante (): RespuestaGenerica{
    $gateway = new PostulanteGateway();
    $useCase = new PostulanteUseCase($gateway);
        return $useCase->listarPostulante();
    }
/*public function listarPostulantePorNombre($Nombre): RespuestaGenerica{ 
     $gateway = new PostulanteGateway();
    $useCase = new PostulanteUseCase($gateway);
        return $useCase->listarPostulantePorNombre($Nombre);
    }*/
public function insertarPostulante (Postulante $postulante):RespuestaGenerica{
    $gateway = new PostulanteGateway();
    $useCase = new PostulanteUseCase($gateway);
        return $useCase->insertarPostulante($postulante);

    }
public function actualizarPostulante ($id, $postulante):RespuestaGenerica{
     $gateway = new PostulanteGateway();
    $useCase = new PostulanteUseCase($gateway);
        return $useCase->actualizarPostulante($id, $postulante);
    }

}
/*$controller = new PostulanteController();
$response = $controller -> listarPostulante();
echo $response-> message; */

/*$controller = new PostulanteController();
$response = $controller->listarPostulantePorNombre ();
echo $response->message;*/

/*$controller = new PostulanteController();
$postulante = new Postulante ();
$postulante -> set("Carrera_idCarrera",1);
$postulante -> set("Usuarios_idUsuarios",2);
$postulante -> set("numeroControl","12");
$postulante -> set("Carrera_idCarrera","44");
$postulante -> set("cvPath","11");
$postulante -> set("telefono","224532");
$postulante -> set("ubicacion","3");
$response = $controller->insertarPostulante($postulante);
echo $response->message;*/

/*$controller = new PostulanteController();
$postulante = new Postulante ();
$postulante -> set("Carrera_idCarrera",1);
$postulante -> set("Usuarios_idUsuarios",2);
$postulante -> set("numeroControl","12");
$postulante -> set("Carrera_idCarrera","44");
$postulante -> set("cvPath","11");
$postulante -> set("telefono","224532");
$postulante -> set("ubicacion","3");
$response = $controller->actualizarPostulante(4,$postulante);
echo $response->message;*/




