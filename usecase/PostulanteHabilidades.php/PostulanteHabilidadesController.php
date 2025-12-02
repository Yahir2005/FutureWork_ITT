 <?php
require_once __DIR__ ."/PostulanteHabilidadesGatawey.php";
require_once __DIR__ ."/PostulanteHabilidadesUseCase.php";
require_once __DIR__ ."/../../Dto/PostulanteHabilidades.php";

 class PostulanteHabilidadesController{
    
    public function insertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):RespuestaGenerica{
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->InsertarPostulanteHabilidades($postulanteHabilidades);
    }
      public function EliminarPostulanteHabilidades($id): RespuestaGenerica{
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->EliminarPostulanteHabilidades($id);
    }
        public function ListarPostulanteHabilidades():RespuestaGenerica{
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->ListarPostulanteHabilidades();
    }
        public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):RespuestaGenerica {
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->ActualizarPostulanteHabilidades($id, $postulanteHabilidades);
    }

 }
 /*$controller = new PostulanteHabilidadesController();
 $postulanteHabilidades= new PostulanteHabilidades();
 $postulanteHabilidades -> set ("Postulante_idPostulante",3);
 $postulanteHabilidades-> set ("Habilidades_idHabilidad",7);
 $result = $controller -> insertarPostulanteHabilidades($postulanteHabilidades);
 echo $result -> message;*/


/*$controller =  new PostulanteHabilidadesController();
$response = $controller-> EliminarPostulanteHabilidades(3);
echo $response->message;*/

/*$controller =  new PostulanteHabilidadesController();
$response = $controller->ListarPostulanteHabilidades();
echo $response->message ;*/

$controller = new PostulanteHabilidadesController();
$postulanteHabilidades = new PostulanteHabilidades();
$postulanteHabilidades->set("Postulante_idPostulante",4);
$postulanteHabilidades->set("Habilidades_idHabilidad",8);
$result = $controller->ActualizarPostulanteHabilidades(1,$postulanteHabilidades);
echo $result->message;