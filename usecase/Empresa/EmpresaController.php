<?php
require_once __DIR__ ."/EmpresaGateway.php";
require_once __DIR__ ."/EmpresaUseCase.php";
require_once __DIR__ ."/../../Dto/Empresa.php";
class EmpresaController{
    public function listarEmpresas(): RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->listarEmpresas();
    }

    public function insertarEmpresas(Empresa $empresa):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->insertarEmpresas($empresa);
    }
}
/*
$controller = new EmpresaController();
$response = $controller->listarEmpresas();
echo $response->message;
*/
/*
$controller = new EmpresaController();
$empresa = new Empresa();
$empresa->set("Usuarios_idUsuarios",2);
$empresa->set("EstadoValidacionEmpresa_idEstadoValidacionEmpresa",1);
$empresa->set("nombreEmpresa","Travelnet");
$empresa->set("sector","Informatica y redes");
$empresa->set("representante","ING Luis Antonio Juarez Ramos");
$empresa->set("descripcion","Instalaciones de internet");
$empresa->set("sitioWeb","Travelnet.com.mx");
$response = $controller->insertarEmpresas($empresa);
echo $response->message;
*/