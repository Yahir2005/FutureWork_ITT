<?php
require_once __DIR__ ."/ImagenesPerfilEmpresaGateway.php";
require_once __DIR__ ."/ImagenesPerfilEmpresaUseCase.php";

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