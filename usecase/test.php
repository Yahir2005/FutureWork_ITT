<?php

require_once __DIR__ . "/../Dto/Usuario.php";
require_once __DIR__ . "/../Dto/Empresa.php";
require_once __DIR__ . "/../usecase/Empresa/EmpresaController.php";
require_once __DIR__ . "/../usecase/Usuario/UsuarioController.php";

    $controllerUsuario = new UsuarioController();
    $controllerEmpresa = new EmpresaController();
    $usuarioObj = new Usuario();
    $empresa = new Empresa();
    $usuarioObj->set("Rol_idRol",1);
    $usuarioObj->set("nombreCompleto","luis pedro");
    $usuarioObj->set("email","luisP");
    $usuarioObj->set("Password","password1s23");
    $resultUsuario = $controllerUsuario->InsertarUsuario($usuarioObj);
    /*
    $empresa->set("Usuarios_idUsuarios",7);
    $empresa->set("EstadoValidacionEmpresa_idEstadoValidacionEmpresa",1);
    $empresa->set("nombreEmpresa","Samsong");
    $empresa->set("sector","electronica");
    $empresa->set("representante","pedro ");
    $empresa->set("descripcion","hellos");
    $empresa->set("sitioWeb","assa");
    $resultEmpresa = $controllerEmpresa->insertarEmpresas($empresa);*/


    echo $resultUsuario->body;
    //echo $resultEmpresa->message;