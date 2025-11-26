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

    public function iniciarSesion(string $usuario, string $contrasena):RespuestaGenerica{
        $response = new RespuestaGenerica();
        try {
            $datosUsuario = $this->gatewayDB->iniciarSesion($usuario, $contrasena);
            if(!empty($datosUsuario)){
                $response->status ="ok";
                $response->body = $datosUsuario; // Devolvemos todos los datos del usuario
                $response->message="Inicio de sesión exitoso";
            }else{
                // Este 'else' no es realmente necesario debido al 'throw' en el Gateway, pero es buena práctica.
                $response->status="error";
                $response->message="Credenciales inválidas";
            }
        } catch (Exception $e) {
            $response->status = "error";
            $response->message = $e->getMessage();
        }
        return $response;
    }

    public function obtenerUsuarioPorId($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDB->obtenerUsuarioPorId($id);
        try {
            $response->status = "ok";
            $response->body=$respuestaMetodo;
            $response->message= "listado Por Id correctamente";
        } catch (Exception $e) {
            $response->status= "error";
            $response->message= "error al listar por Id";
        }
        return $response;
    }

    public function obtenerIdRolUsuarios($id):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuestaMetodo = $this->gatewayDB->obtenerIdRolUsuarios($id);
        try {
            $response->status = "ok";
            $response->body=$respuestaMetodo;
            $response->message= "Error al obtener el rol del usuario";
        } catch (Exception $e) {
            $response->status= "error";
            $response->message= "Error al obtener rol usuario".$e->getMessage();
        }
        return $response;
    }

    public function iniciarSesionEmpresa(string $usuario, string $contrasena):RespuestaGenerica{
        $response = new RespuestaGenerica();
        $respuesMetodo = $this->gatewayDB->iniciarSesionEmpresa($usuario, $contrasena);
        try {
            $response->status = "ok";
            $response->body=$respuesMetodo;
            $response->message= "Se inicio correctamente la sesion empresa";
        } catch (Exception $e) {
            $response->status= "error";
            $response->message= "Error al iniciar sesion empresa".$e->getMessage();
        }
        return $response;
    }
    
}