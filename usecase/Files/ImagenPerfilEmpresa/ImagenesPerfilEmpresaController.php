<?php
require_once __DIR__ ."/ImagenesPerfilEmpresaGateway.php";
require_once __DIR__ ."/ImagenesPerfilEmpresaUseCase.php";
require_once __DIR__ ."/../../../Dto/ImagenPerfilEmpresa.php";

class ImagenesPerfilEmpresaController{
    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):RespuestaGenerica{
        $gateway = new ImagenesPerfilEmpresaGateway();
        $useCase = new ImagenesPerfilEmpresaUseCase($gateway);
        return $useCase->InsertarImagenPerfilEmpresa($imagenPerfilEmpresa);
    }

    public function eliminarImagen($id):RespuestaGenerica{
        $gateway = new ImagenesPerfilEmpresaGateway();
        $useCase = new ImagenesPerfilEmpresaUseCase($gateway);
        return $useCase->eliminarImagen($id);
    }

    public function obtenerImagenes($id):RespuestaGenerica{
        $gateway = new ImagenesPerfilEmpresaGateway();
        $useCase = new ImagenesPerfilEmpresaUseCase($gateway);
        return $useCase->obtenerImagenes($id);
    }
    
}
/*
$controller = new ImagenesPerfilEmpresaController();
$obj = new ImagenPerfilEmpresa();
$obj->set("Empresas_idEmpresas",2);
$obj->set("urlImagenPerfilEmpresa","werrew");
$result = $controller->InsertarImagenPerfilEmpresa($obj);
echo $result->message;*/
/*
$controller = new ImagenesPerfilEmpresaController();
$result = $controller->obtenerImagenes(2);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilEmpresaController();
$result = $controller->eliminarImagen(2);
echo $result->message;*/
