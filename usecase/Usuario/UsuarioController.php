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

    public function DeleteUsuario($id):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->DeleteUsuario($id);
        return $response;
    }

    public function iniciarSesion(string $usuario, string $contrasena ):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->iniciarSesion($usuario, $contrasena);
        return $response;
    }

    public function obtenerUsuarioPorId($id):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->obtenerUsuarioPorId($id);
        return $response;
    }

    public function obtenerIdRolUsuarios($id):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->obtenerIdRolUsuarios($id);
        return $response;
    }

    public function iniciarSesionG(string $usuario, string $contrasena):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->iniciarSesionG($usuario, $contrasena);
        return $response;
    }

    public function getIdByRol($idRol):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->getIdByRol($idRol);
        return $response;
    }

    public function obtenerEntidadPorUsuario(int $idUsuario):RespuestaGenerica{
        $gatewayDB = new UsuarioGatewey();
        $usuarioUseCase = new UsuarioUseCase($gatewayDB);
        $response = $usuarioUseCase->obtenerEntidadPorUsuario($idUsuario);
        return $response;
    }

}


/*
$controller = new UsuarioController();
$result = $controller->iniciarSesionEmpresa("PaolaRl@gmail.com", "fdsf1234" );
echo $result->message;
*/
/*
$controller = new UsuarioController();
$response = $controller->obtenerIdRolUsuarios(2);
echo $response->message;
*/
/*
$controller = new UsuarioController();
$result = $controller->obtenerUsuarioPorId(1);
echo $result->message;
*/
/*
$controller = new UsuarioController();
$result = $controller->iniciarSesion ("PaolaRl@gmail.com", "fdsf1234" );
echo $result->message;
*/
/**Testeos de Metodos de un CRUD Basico :) */
/*
/**Metodo insertar */
/*
$controller =  new UsuarioController();
$usuarioObj = new Usuario();
$usuarioObj->set("Rol_idRol",1);
$usuarioObj->set("nombreCompleto","Wendy Paola Ramoz Lopez");
$usuarioObj->set("email","PaolaRl@gmail.com");
$usuarioObj->set("Password","fdsf1234");
$response = $controller->InsertarUsuario($usuarioObj);
echo $response->message ;
*/
/**Metodo Listar*/
/*
$controller =  new UsuarioController();
$response = $controller->ListarUsuarios();
echo $response->message ;
*/
/**Metodo Actualizar */
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
/**Metodo Eliminar */
/*
$controller =  new UsuarioController();
$response = $controller->DeleteUsuario(1);
echo $response->message;
*/