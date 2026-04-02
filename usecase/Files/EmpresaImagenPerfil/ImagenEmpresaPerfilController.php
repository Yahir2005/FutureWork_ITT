<?php
require_once __DIR__ ."/../../../Dto/ImagenEmpresaPerfil.php";
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";
require_once __DIR__ ."/ImagenEmpresaPerfilGateway.php";
require_once __DIR__ ."/ImagenEmpresaPerfilUseCase.php";

class ImagenEmpresaPerfilController{
    public function subirImagenPerfilEmpresa(EmpresaImagenPerfil $imagenData):RespuestaGenerica{
        $gateway = new ImagenEmpresaPerfilGateway();
        $useCase = new ImagenEmpresaPerfilUseCase($gateway);
        return $useCase->subirImagenPerfilEmpresa($imagenData);
    }
}
/*
$controller = new ImagenEmpresaPerfilController();
$objImagen = new ImagenEmpresaPerfil();
$objImagen->set("Nombre", "Imagen de perfil de ffmpresa");
$objImagen->set("rutaImagenPerfilEmpresa", "ruta/a/la/imaffen.jpg");
$result = $controller->subirImagenPerfilEmpresa($objImagen);
echo $result->message;
*/