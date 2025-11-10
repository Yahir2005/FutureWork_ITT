<?php
require_once __DIR__ ."/ImagenesEmpresaGateway.php";
require_once __DIR__ ."/ImagenesEmpresaUseCase.php";
require_once __DIR__ ."/../../../Dto/ImagenesEmpresa.php";

class ImagenesEmpresaController{
    public function subirImagenEmpresa(ImagenesEmpresa $imagenData):RespuestaGenerica{
        $gateway = new ImagenesEmpresaGateway();
        $useCase = new ImagenesEmpresaUseCase($gateway);
        return $useCase-> subirImagenEmpresa($imagenData);
    }

    public function ListarImagenesEmpresa(): RespuestaGenerica{
        $gateway = new ImagenesEmpresaGateway();
        $useCase = new ImagenesEmpresaUseCase($gateway);
        return $useCase-> ListarImagenesEmpresa();
     }

     public function eliminarImagenEmpresa($idEmpresa): RespuestaGenerica{
        $gateway = new ImagenesEmpresaGateway();
        $useCase = new ImagenesEmpresaUseCase($gateway);
        return $useCase-> eliminarImagenEmpresa($idEmpresa);
     }
}
/*
$controller = new ImagenesEmpresaController();
$imagenData = new ImagenesEmpresa();
$imagenData->set("Empresas_idEmpresas",1);
$imagenData->set("urlImagen","/adsdsa");
$response = $controller->subirImagenEmpresa($imagenData);
echo $response->message;*/
/*
$controller = new ImagenesEmpresaController();
$result = $controller->listarImagenesEmpresa();
echo $result->message;*/
/*
$controller = new ImagenesEmpresaController();
$result = $controller->eliminarImagenEmpresa(3);
echo $result->message;*/
