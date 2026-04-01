<?php
require_once __DIR__ ."/IImagenEmpresaPerfil.php";
require_once __DIR__ ."/../../../Dto/ImagenEmpresaPerfil.php";
require_once __DIR__ ."/../../../Dto/RespuestaGenerica.php";

class ImagenEmpresaPerfilUseCase{
    private $gateway;
    public function __construct(IImagenEmpresaPerfil $gateway) {
        $this->gateway = $gateway;
    }

    public function subirImagenPerfilEmpresa(ImagenEmpresaPerfil $imagenData): RespuestaGenerica {
        $respuestaGenerica = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gateway->subirImagenPerfilEmpresa($imagenData);
            if($respuestaMetodo){
                $respuestaGenerica-> status="ok";
                $respuestaGenerica->body = true;
                $respuestaGenerica->message = "Registro exitoso";
            }else{
                $respuestaGenerica-> status="Error";
                $respuestaGenerica->body = false;
                $respuestaGenerica->message = "Error al Registro";
            }
        } catch (Throwable $e) {
            $respuestaGenerica->status= "error";
            $respuestaGenerica->message = $e->getMessage();
        }
        return $respuestaGenerica;
    }
}