<?php
require_once __DIR__ ."/ImagenesPostulanteGateway.php";
require_once __DIR__ ."/ImagenesPostulanteUseCase.php";

class ImagenesPostulanteController{
    public function InsertarImagenPostulante(ImagenesPostulante $imagenesPostulante):RespuestaGenerica{
        $gatewayDb = new ImagenesPostulanteGateway();
        $UseCase = new ImagenesPostulanteUseCase($gatewayDb);
        return $UseCase->InsertarImagenPostulante($imagenesPostulante);
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $gatewayDb = new ImagenesPostulanteGateway();
        $UseCase = new ImagenesPostulanteUseCase($gatewayDb);
        return $UseCase->eliminarImagen($id);
    } 

    public function obtenerImagenes():RespuestaGenerica{
        $gatewayDb = new ImagenesPostulanteGateway();
        $UseCase = new ImagenesPostulanteUseCase($gatewayDb);
        return $UseCase->obtenerImagenes();
    }
}