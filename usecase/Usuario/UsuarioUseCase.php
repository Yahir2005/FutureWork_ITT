<?php
 require_once __DIR__ .'/IUsuarioGateway.php';
 require_once __DIR__ .'/../../Dto/RespuestaGenerica.php';
class UsuarioUseCase { 
    private $gatewayDB;
    public function __construct(IUsuarioGateway $gatewayDB){
        $this->gatewayDB = $gatewayDB;
    }

    public function InsertarUsuario(Usuario $usuario):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDB->InsertarUsuario($usuario);
            if($respuestaMetodo){
                $response->status ="ok";
                $response->body=$respuestaMetodo;
                $response->message="Registro Exitoso";
            }else{
                $response->status="error";
                $response->body=false;
                $response->message="Error al registrar";
            }
        } catch (Exception $e) {
            $response->message = $e->getMessage();
        }
        return $response;
    }

}