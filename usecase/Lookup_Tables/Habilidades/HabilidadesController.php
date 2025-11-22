<?php

use LDAP\Result;

require_once __DIR__ ."/HabilidadesGateway.php";
require_once __DIR__ ."/HabilidadesUseCase.php";

class   HabilidadesController {
     public function listarHabilidades():RespuestaGenerica{
        $gateway = new HabilidadesGateway();
        $usecase = new HabilidadesUseCase($gateway);
        return $usecase-> listarHabilidades();
     }

}

/*$controller = new HabilidadesController();
$Result = $controller-> listarHabilidades();
echo $Result -> message;*/



// es un contrato donde exige que todas las clases que la implementen tenga sus mismos metodos
//usecse detecta errores
//gateway es donde se encuentra el metodo
// el controller es la forma en como nos vamos a conectas desde el backend hasta el frontend