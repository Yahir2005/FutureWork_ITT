<?php
require_once __DIR__ ."/PostulanteCertificacionGateway.php";
require_once __DIR__ ."/PostulanteCertificacionUseCase.php";
require_once __DIR__ ."/IPostulanteCertificacion.php";
require_once __DIR__ ."/../../Dto/PostulanteCertificacion.php";

class   PostulanteCertificacionController {

    public function ListarPostulanteCertificacion():RespuestaGenerica {
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
$objpostulante = new PostulanteCertificacion();
$objpostulante->set("Postulante_idPostulante", 1);
$objpostulante->set("Certificaciones_idCertificacion", 2);
$result = $controller->InsertarPostulanteCertificacion($objpostulante);
echo $result->message;
*/

/*
-----------------------------------------
 PRUEBA: Actualizar PostulanteCertificacion
-----------------------------------------
$controller = new PostulanteCertificacionController();
$objpostulante = new PostulanteCertificacion();
$objpostulante->set("Postulante_idPostulante", 3);
$objpostulante->set("Certificaciones_idCertificacion", 4);
$result = $controller->ActualizarPostulanteCertificacion(1, $objpostulante);
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
 PRUEBA: Listar PostulanteCertificacion MEJORADO
-----------------------------------------
$controller = new PostulanteCertificacionController();
$response = $controller->listarPostulanteCertificacion();

foreach ($response->body as $row) {
    echo "ID: " . $row['idPostulanteCertificacion'] . " - ";
    echo "Postulante: " . $row['Postulante_idPostulante'] . " - ";
    echo "Certificación: " . $row['Certificaciones_idCertificacion'] . "<br>";
}

echo $response->message;
*/


/*
-----------------------------------------
 PRUEBA: Listar PostulanteCertificacion BASICA
-----------------------------------------*//*
$controller = new PostulanteCertificacionController();
$response = $controller->listarPostulanteCertificacion();

$listar = $response->body;
foreach ($listar as $row) {
    echo $row['banana'] . "<br>";
}
echo $response->message;
*/