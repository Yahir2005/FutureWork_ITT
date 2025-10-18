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

$controller =  new UsuarioController();

$usuarioObj = new Usuario();

$usuarioObj->set("idRol",2);
$usuarioObj->set("nombreCompleto","Juarez Duran Luis Yahir");
$usuarioObj->set("email","yahir@gmail.com");
$usuarioObj->set("contraseñaHash","1223533");
$response = $controller->InsertarUsuario($usuarioObj);
echo $response->message;