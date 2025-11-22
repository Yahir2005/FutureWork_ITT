<?php
require_once __DIR__ . "/ImagenesPerfilPostulanteGateway.php";
require_once __DIR__ ."/ImagenesPerfilPostulanteUseCase.php";
require_once __DIR__ ."/../../../Dto/ImagenesPerfilPostulante.php";

class ImagenesPerfilPostulanteController{

    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante): RespuestaGenerica{
        $gatewayDb = new ImagenesPerfilPostulanteGateway();
    $useCase = new ImagenesPerfilPostulanteUseCase($gatewayDb);
    return $useCase->InsertarImagenPerfilPostulante($imagenesPerfilPostulante);
    }
    
   public function EliminarImagenPerfilPostulante($id): RespuestaGenerica{
        $gatewayDb = new ImagenesPerfilPostulanteGateway();
        $useCase = new ImagenesPerfilPostulanteUseCase($gatewayDb);
        return $useCase->EliminarImagenPerfilPostulante($id);
    }

    public function MostrarImagenPerfilPostulante($id): RespuestaGenerica{
        $gatewayDb = new ImagenesPerfilPostulanteGateway();
        $useCase = new ImagenesPerfilPostulanteUseCase($gatewayDb);
        return $useCase->MostrarImagenPerfilPostulante($id);
    }

    public function perfilPostulante($id): RespuestaGenerica{
        $gatewayDb = new ImagenesPerfilPostulanteGateway();
        $useCase = new ImagenesPerfilPostulanteUseCase($gatewayDb);
        return $useCase->perfilPostulante($id);
    }
}
/*
$controller = new ImagenesPerfilPostulanteController;
$result = $controller->perfilPostulante(1);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilPostulanteController;
$objImagen = new ImagenesPerfilPostulante();
$objImagen->set("Postulante_idPostulante",1);
$objImagen->set("urlImagenPerfilPostulante","/sfdsdsf");
$result = $controller->InsertarImagenPerfilPostulante($objImagen);
echo $result->message;*/
/*
$controller = new ImagenesPerfilPostulanteController;
$result = $controller->mostrarImagenPerfilPostulante(1);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilPostulanteController();
$result = $controller->EliminarImagenPerfilPostulante(3);
echo $result->message;
*/