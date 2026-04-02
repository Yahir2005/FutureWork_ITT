<?php
require_once __DIR__ ."/../../../Dto/EmpresaImagenPerfil.php";
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
$objImagen = new EmpresaImagenPerfil();
$objImagen->set("Nombre", "Imagen de perfil de empresa");
$objImagen->set("rutaImagenPerfilEmpresa", "ruta/a/la/imaffen.jpg");
$result = $controller->subirImagenPerfilEmpresa($objImagen);
echo $result->message;
*/