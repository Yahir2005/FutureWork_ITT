<?php
require_once __DIR__ ."/ImagenesPostulanteGateway.php";
require_once __DIR__ ."/ImagenesPostulanteUseCase.php";
require_once __DIR__ ."/../../../Dto/ImagenesPostulante.php";

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
/*
$controller = new ImagenesPostulanteController();
$obj = new ImagenesPostulante();
$obj->set("Postulante_idPostulante",2);
$obj->set("urlImagen","sfdfds");
$result = $controller->InsertarImagenPostulante($obj);
echo $result->message;*/
/*
$controller = new ImagenesPostulanteController();
$result = $controller->obtenerImagenes();
echo $result->message;*/
/*
$controller = new ImagenesPostulanteController();
$result = $controller->eliminarImagen(2);
echo $result->message;*/