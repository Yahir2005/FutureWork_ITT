<?php
require_once __DIR__ ."/ImagenesPostulanteGateway.php";
require_once __DIR__ ."/ImagenesPostulanteUseCase.php";

class ImagenesPostulanteController{
    public function obtenerImagenPostulante(ImagenesPostulante $imagenesPostulante):RespuestaGenerica{
        $gatewayDb = new ImagenesPostulanteGateway();
        $UseCase = new ImagenesPostulanteUseCase($gatewayDb);
        return $UseCase->obtenerImagenPostulante($imagenesPostulante);
    }
}