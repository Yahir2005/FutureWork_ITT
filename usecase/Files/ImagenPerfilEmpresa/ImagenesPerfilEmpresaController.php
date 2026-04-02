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
    
    public function perfilEmpresa($id):RespuestaGenerica{
        $gateway = new ImagenesPerfilEmpresaGateway();
        $useCase = new ImagenesPerfilEmpresaUseCase($gateway);
        return $useCase->perfilEmpresa($id);
    }

}
/*
$controller = new ImagenesPerfilEmpresaController();
$result = $controller->perfilEmpresa(1);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilEmpresaController();
$obj = new ImagenPerfilEmpresa();
$obj->set("Empresas_idEmpresas",2);
$obj->set("EmpresaPerfilImagen_idEmpresaPerfilImagen",1);
$result = $controller->InsertarImagenPerfilEmpresa($obj);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilEmpresaController();
$result = $controller->obtenerImagenes(2);
echo $result->message;
*/
/*
$controller = new ImagenesPerfilEmpresaController();
$result = $controller->eliminarImagen(2);
echo $result->message;*/
