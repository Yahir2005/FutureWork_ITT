<?php
require_once __DIR__ ."/EstadoPostulacionGateway.php";
require_once __DIR__ ."/EstadoPostulacionUseCase.php";
require_once __DIR__ ."/../../../Dto/EstadoPostulacion.php";
require_once __DIR__ ."/IEstadoPostulacion.php";

class   EstadoPostulacionController {

    public function listarEstadoPostulacion():RespuestaGenerica{
        $gatewayDb = new EstadoPostulacionGateway();
        $usecase = new EstadoPostulacionUseCase($gatewayDb);
        return $usecase-> listarEstadoPostulacion();
     }

    public function listarEstadoPostulacionPorId($idEstadoPostulacion):RespuestaGenerica{
        $gatewayDb = new EstadoPostulacionGateway();
        $usecase = new EstadoPostulacionUseCase($gatewayDb);
        return $usecase-> listarEstadoPostulacionPorId($idEstadoPostulacion);
     }

}

/*$controller = new EstadoPostulacionController();
$response = $controller->listarEstadoPostulacion();
echo $response-> message;

$controller = new EstadoPostulacionController();
$response = $controller->listarEstadoPostulacionPorId($idEstadoPostulacion);
echo $response-> message;*/

/**class EstadoPostulacionController{

     public function listarEstadoPostulacion(): RespuestaGenerica{
        $gateway = new EstadoPostulacionGateway();
        $useCase = new EstadoPostulacionUseCase($gateway);
        return $useCase-> listarEstadoPostulacion();
     }
}*/



/*$controller = new PostulanteCertificacionController();
$result  = $controller->listarPostulanteCertificacion();
echo $result->message;*/

/*
-----------------------------------------
 PRUEBA: Insertar PostulanteCertificacion
-----------------------------------------
$controller = new PostulanteCertificacionController();
$objPostulanteCertificacion = new PostulanteCertificacion();
$objPostulanteCertificacion->set("nombreHabilidad", "Trabajo en equipo PO");
$result = $controller->InsertarPostulanteCertificacion($objPostulanteCertificacion);
echo $result->message;
*/

/*
-----------------------------------------
 PRUEBA: Actualizar PostulanteCertificacion
-----------------------------------------
$controller = new PostulanteCertificacionController();
$objPostulanteCertificacion = new objPostulanteCertificacion();
$objPostulanteCertificacion->set("nombreHabilidad", "Comunicación efectiva");
$result = $controller->ActualizarPostulanteCertificacion(1, $objPostulanteCertificacion);
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
-----------------------------------------
$controller = new PostulanteCertificacionController();
$response = $controller->listarPostulanteCertificacion();

$listar = $response->body;
foreach ($listar as $row) {
    echo $row['nombreHabilidad'] . "<br>";
}
echo $response->message;
*/