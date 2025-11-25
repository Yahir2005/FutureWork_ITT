<?php

use LDAP\Result;

require_once __DIR__ ."/HabilidadesGateway.php";
require_once __DIR__ ."/HabilidadesUseCase.php";
require_once __DIR__ . "/IHabilidades.php";

class   HabilidadesController {
     public function listarHabilidades():RespuestaGenerica{
        $gatewayDb = new HabilidadesGateway();
        $usecase = new HabilidadesUseCase($gatewayDb);
        return $usecase-> listarHabilidades();
     }
     
    public function InsertarHabilidades(Habilidades $habilidades):RespuestaGenerica{
        $gatewayDb = new HabilidadesGateway();
        $usecase = new HabilidadesUseCase($gatewayDb);
        return $usecase->InsertarHabilidades($habilidades);
    }


    /*public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):RespuestaGenerica {
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->ActualizarPostulanteHabilidades($id, $postulanteHabilidades);
    }

    public function EliminarPostulanteHabilidades($id): RespuestaGenerica{
        $gatewayDb = new PostulanteHabilidadesGatawey();
        $usecase = new PostulanteHabilidadesUseCase($gatewayDb);
        return $usecase->EliminarPostulanteHabilidades($id);
    }
*/
}













/*$controller = new HabilidadesController();
$Result = $controller-> listarHabilidades();
echo $Result -> message;*/



// es un contrato donde exige que todas las clases que la implementen tenga sus mismos metodos
//usecse detecta errores
//gateway es donde se encuentra el metodo
// el controller es la forma en como nos vamos a conectas desde el backend hasta el frontend