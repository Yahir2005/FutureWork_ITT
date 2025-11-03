<?php
require_once __DIR__ .'/UsuarioGatewey.php';
require_once __DIR__ .'/UsuarioUseCase.php';
require_once __DIR__ .'/../../Dto/Usuario.php';

class UsuarioController{
    public function InsertarUsuario(Usuario $usuario):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->InsertarUsuario($usuario);
        return $response;
    }

    public function ListarUsuarios(): RespuestaGenerica {
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->ListarUsuarios();
        return $response;
    }

    public function ActualizarUsuarios($id, $usuario):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->ActualizarUsuarios($id, $usuario);
        return $response;
    } 
}
/*
$controller =  new UsuarioController();
$usuarioObj = new Usuario();
$usuarioObj->set("Rol_idRol",1);
$usuarioObj->set("nombreCompleto","Juarez Duran luis Yahir");
$usuarioObj->set("email","yahir@gmail.com");
$usuarioObj->set("Password","sfdfds");
$response = $controller->InsertarUsuario($usuarioObj);
echo $response->message ;
*/

/*
$controller =  new UsuarioController();
$response = $controller->ListarUsuarios();
echo $response->message ;
*/
/*
$controller =  new UsuarioController();
$usuarioObj = new Usuario();
$usuarioObj->set("Rol_idRol",2);
$usuarioObj->set("nombreCompleto","Actualizado Luis Yahir");
$usuarioObj->set("email","actualizado.yahir@gmail.com");
$usuarioObj->set("Password","nuevoPassword");
$response = $controller->ActualizarUsuarios(1,$usuarioObj);
echo $response->message;
*/