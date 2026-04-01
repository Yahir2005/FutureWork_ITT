<?php
    $MessageID = "";
    $idUsuario = $_SESSION["idUsuarios"];
    /*Direcciones */
    require_once __DIR__ ."/../../usecase/Empresa/EmpresaController.php";
    require_once __DIR__ ."/../../usecase/Usuario/UsuarioController.php";
    require_once __DIR__ ."/../../Dto/Empresa.php";
    require_once __DIR__ ."/../../Dto/Usuario.php";

    /**Controllers */
    $empresaController = new EmpresaController();
    $usuarioController = new UsuarioController();
    $empresaObject = new Empresa();
    $usuarioObject = new Usuario();

    /**Metodos */
    $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
    $datos = $result->body;
    $idEmpresa = $datos['empresaId'];

    /**Metodo Insertar */
    if(isset($_POST["registrarUsuarioAdmin"])){
        $usuarioObject->set("Rol_idRol",1);
        $usuarioObject->set("nombreCompleto",$_POST["nombreCompleto"]);
        $usuarioObject->set("email",$_POST["email"]);
        $usuarioObject->set("Password",$_POST["Password"]);
        $resultUsuario = $usuarioController->InsertarUsuario($usuarioObject);
    }

?>