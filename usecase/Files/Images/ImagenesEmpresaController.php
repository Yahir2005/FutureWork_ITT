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