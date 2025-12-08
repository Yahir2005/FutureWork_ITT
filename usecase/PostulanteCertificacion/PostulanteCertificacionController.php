<?php
require_once __DIR__ ."/PostulanteCertificacionGateway.php";
require_once __DIR__ ."/PostulanteCertificacionUseCase.php";
require_once __DIR__ ."/IPostulanteCertificacion.php";

class   PostulanteCertificacionController {

    public function listarPostulanteCertificacion():RespuestaGenerica {
        $gatewayDb = new PostulanteCertificacionGateway();
        $useCase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $useCase->listarPostulanteCertificacion();
        return $response;
    }
    public function InsertarPostulanteCertificacion(PostulanteCertificacion $postulanteCertificacion):RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->InsertarPostulanteCertificacion($postulanteCertificacion);
        return $response;
    }
    
    public function ActualizarPostulanteCertificacion($id, $postulanteCertificacion):RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->ActualizarPostulanteCertificacion($id, $postulanteCertificacion);
        return $response;
    }

    public function EliminarPostulanteCertificacion($id): RespuestaGenerica{
        $gatewayDb = new PostulanteCertificacionGateway();
        $usecase = new PostulanteCertificacionUseCase($gatewayDb);
        $response = $usecase->EliminarPostulanteCertificacion($id);
        return $response;
    }

}
/*$controller = new PostulanteCertificacionController();
$result  = $controller->listarPostulanteCertificacion();
echo $result->message;*/

/*
-----------------------------------------
 PRUEBA: Insertar PostulanteCertificacion
-----------------------------------------*//*
$controller = new PostulanteCertificacionController();
$objpostulanteCertificacion = new PostulanteCertificacion();
$objpostulanteCertificacion->set("Postulante_idInformacionPolstulante", "Prueba de don dimadon");
$objpostulanteCertificacion->set("Certificaciones_idCertificacion", "El torero");
$result = $controller->InsertarPostulanteCertificacion($objpostulanteCertificacion);
echo $result->message;*/


/*
-----------------------------------------
 PRUEBA: Actualizar PostulanteCertificacion
-----------------------------------------
$controller = new PostulanteCertificacionController();
$objpostulanteCertificacion = new PostulanteCertificacion();
$objpostulanteCertificacion->set("Postulante_idInformacionPolstulante", "Actualizacion de los terrenos nuevos");
$objpostulanteCertificacion->set("Certificaciones_idCertificacion", "El toro bailarin");
$result = $controller->ActualizarPostulanteCertificacion(1, $objpostulanteCertificacion);
echo $result->message;
*/

/*
-----------------------------------------
 PRUEBA: Eliminar PostulanteCertificacion
-----------------------------------------
$controller = new PostulanteCertificacionController();
$result = $controller->EliminarPostulanteCertificacion(1);
echo $result->message;
*/

/*
-----------------------------------------
 PRUEBA: Listar PostulanteCertificacion
-----------------------------------------*//*
$controller = new PostulanteCertificacionController();
$response = $controller->listarPostulanteCertificacion();

$listar = $response->body;
foreach ($listar as $row) {
    echo $row['banana'] . "<br>";
}
echo $response->message;
*/