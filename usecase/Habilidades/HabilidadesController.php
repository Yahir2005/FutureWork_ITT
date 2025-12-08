<?php

require_once __DIR__ ."/HabilidadesGateway.php";
require_once __DIR__ ."/HabilidadesUseCase.php";
require_once __DIR__ ."/../../Dto/habilidades.php";

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
    
    public function ActualizarHabilidades($id, $habilidades):RespuestaGenerica{
        $gatewayDb = new HabilidadesGateway();
        $usecase = new HabilidadesUseCase($gatewayDb);
        return $usecase->ActualizarHabilidades($id,$habilidades);
    }

    public function EliminarHabilidades($id): RespuestaGenerica{
        $gatewayDb = new HabilidadesGateway();
        $usecase = new HabilidadesUseCase($gatewayDb);
        return $usecase->EliminarHabilidades($id);
    }

}

/*
$controller = new HabilidadesController();
$Result = $controller-> listarHabilidades();
echo $Result -> message;
*/

/*
//-----------------------------------------
// PRUEBA: Insertar habilidad
//-----------------------------------------*//*
$controller = new HabilidadesController();
$objhabilidad = new Habilidades();
$objhabilidad->set("nombreHabilidad", "PruebaPolaski");
$result = $controller->InsertarHabilidades($objhabilidad);
echo $result->message;*/


/*
-----------------------------------------
 PRUEBA: Actualizar habilidad
-----------------------------------------*//*
$controller = new HabilidadesController();
$habilidad = new Habilidades();
$habilidad->set("nombreHabilidad", "Actualizacion pruba Polaski 2.0");
$result = $controller->ActualizarHabilidades(2, $habilidad);
echo $result->message;*/


/*
//-----------------------------------------
/// PRUEBA: Eliminar habilidad
//-----------------------------------------*//*
$controller = new HabilidadesController();
$result = $controller->EliminarHabilidades(1);
echo $result->message;*/


/*
-----------------------------------------
 PRUEBA: Listar habilidades
-----------------------------------------*//*
$controller = new HabilidadesController();
$response = $controller->listarHabilidades();

$listar = $response->body;
foreach ($listar as $row) {
    echo $row['nombreHabilidad'] . "<br>";
}
echo $response->message;*/



// es un contrato donde exige que todas las clases que la implementen tenga sus mismos metodos
//usecse detecta errores
//gateway es donde se encuentra el metodo
// el controller es la forma en como nos vamos a conectas desde el backend hasta el frontend