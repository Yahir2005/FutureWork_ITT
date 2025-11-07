<?php
require_once __DIR__ ."/../../../Dto/EstadoPostulacion.php";

class ImagenesEmpresaUseCase{
    private $gateway;

    public function __construct(IImagenesEmpresa $gateway){
        $this->gateway = $gateway;
    }

    public function subirImagenEmpresa(ImagenesEmpresa $imagenData):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gateway->subirImagenEmpresa($imagenData);
            if($respuestaMetodo){
                $response ->status = "ok";
                $response ->body = true;
                $response ->message = "Registro Exitoso de Imagen Empresa";
            }else{
                $response ->status = "error";
                $response ->body = false;
                $response ->message = "Error al registrar la Imagen Empresa";
            }
        } catch (Exception  $e) {
            $response ->status = "error";
            $response ->message = $e -> getMessage();
        }
        return $response;
    }

    public function ListarImagenesEmpresa():RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gateway->ListarImagenesEmpresa();
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Listado de Imagenes Empresa";
        } catch (Exception  $e) {
            $response ->status = "error";
            $response ->message = $e -> getMessage();
        }
        return $response;
    }

    public function eliminarImagenEmpresa($idEmpresa):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gateway->eliminarImagenEmpresa($idEmpresa);
        try {
            $response ->status = "ok";
            $response ->body = $respuestaMetodo;
            $response ->message = "Imagen Empresa eliminada correctamente";
        } catch (Exception  $e) {
            $response ->status = "error";
            $response ->message = "Error al insertar empresa".$e -> getMessage();
        }
        return $response;
    }

}