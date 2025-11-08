<?php
require_once __DIR__ . "/ImagenesPerfilPostulanteGateway.php";
require_once __DIR__ ."/ImagenesPerfilPostulanteUseCase.php";

class ImagenesPerfilPostulanteController{

    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante): RespuestaGenerica{
        $gatewayDb = new ImagenesPerfilPostulanteGateway();
    $useCase = new ImagenesPerfilPostulanteUseCase($gatewayDb);
    return $useCase->InsertarImagenPerfilPostulante($imagenesPerfilPostulante);
    }
    
}