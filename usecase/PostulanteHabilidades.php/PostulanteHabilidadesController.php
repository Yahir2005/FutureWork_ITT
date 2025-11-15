 <?php
require_once __DIR__ ."/PostulanteHabilidadesGatawey.php";
require_once __DIR__ ."/PostulanteHabilidadesUseCase.php";
require_once __DIR__ ."/../../Dto/PostulanteHabilidades.php";
 class PostulanteHabilidadesController{
    public function InsertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):RespuestaGenerica{
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->InsertarPostulanteHabilidades($postulanteHabilidades);
    }
    public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):RespuestaGenerica {
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->ActualizarPostulanteHabilidades($id, $postulanteHabilidades);
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

 }
 $controller = new PostulanteHabilidadesController();
 $result = $controller -> ListarPostulanteHabilidades();
 echo $result -> message;
 