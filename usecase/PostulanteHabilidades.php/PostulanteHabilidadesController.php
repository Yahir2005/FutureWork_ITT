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

 }
 /*$controller = new PostulanteHabilidadesController();
 $postulanteHabilidades= new PostulanteHabilidades();
 $postulanteHabilidades -> set ("Postulante_idPostulante",1);
 $postulanteHabilidades-> set ("Habilidades_idHabilidad",1);
 $result = $controller -> insertarPostulanteHabilidades($postulanteHabilidades);
 echo $result -> message;*/
 