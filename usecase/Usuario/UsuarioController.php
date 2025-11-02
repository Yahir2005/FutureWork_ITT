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