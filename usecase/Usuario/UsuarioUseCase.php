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

    public function ListarUsuarios(): RespuestaGenerica {
        $response = new RespuestaGenerica();
        try {
            $usuarios = $this->gatewayDB->ListarUsuarios();
            $response->status = "ok";
            $response->body = $usuarios;
            $response->message = "Usuarios listados correctamente";
        } catch (Exception $e) {
            $response->status = "error";
            $response->body = [];
            $response->message = "Error al listar usuarios: " . $e->getMessage();
        }
        return $response;
    }

    public function ActualizarUsuarios($id, $usuario):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDB->ActualizarUsuarios($id, $usuario);
            if($respuestaMetodo){
                $response->status ="ok";
                $response->body=$respuestaMetodo;
                $response->message="Actualización Exitosa";
            }else{
                $response->status="error";
                $response->body=false;
                $response->message="Error al actualizar";
            }
        } catch (Exception $e) {
            $response->message = $e->getMessage();
        }
        return $response;
    }

    public function DeleteUsuario($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $respuestaMetodo = $this->gatewayDB->DeleteUsuario($id);
            if($respuestaMetodo){
                $response->status ="ok";
                $response->body=$respuestaMetodo;
                $response->message="Eliminación Exitosa";
            }else{
                $response->status="error";
                $response->body=false;
                $response->message="Error al eliminar";
            }
        } catch (Exception $e) {
            $response->message = $e->getMessage();
        }
        return $response;
    }
    
}