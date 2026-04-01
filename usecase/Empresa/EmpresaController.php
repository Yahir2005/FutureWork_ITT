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

    public function actualizarEmpresas($id, $empresa):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->actualizarEmpresas($id, $empresa);
    }

    public function eliminarEmpresas($id):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->eliminarEmpresas($id);
    }

    public function buscarEmpresasPorNombre($Nombre):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->buscarEmpresasPorNombre($Nombre);
    }

    public function buscarEmpresasPorSector($Sector):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->buscarEmpresasPorSector($Sector);
    }

    public function buscarEmpresasPorTipoEstado($Tipo):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->buscarEmpresasPorTipoEstado($Tipo);
    }

    public function actualizarEstadoEmpresa($id,$empresa):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->actualizarEstadoEmpresa($id,$empresa);
    }

    public function obtenerEmpresaPorIdUsuario($id):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->obtenerEmpresaPorIdUsuario($id);
    }

    public function contarEmpresasPorValidacion($id):RespuestaGenerica{
        $gateway = new EmpresaGateway();
        $useCase = new EmpresaUseCase($gateway);
        return $useCase->contarEmpresasPorValidacion($id);
    }

}
/*
$controller = new EmpresaController();
$empresa = new Empresa();
$empresa->set("EstadoValidacionEmpresa_idEstadoValidacionEmpresa",1);
$result = $controller->actualizarEstadoEmpresa(1,$empresa);
echo $result->message;
*/
/*
$controller = new EmpresaController();
$result = $controller->buscarEmpresasPorTipoEstado(1);
echo $result->message;
*/
/*
$controller = new EmpresaController();
$result = $controller->buscarEmpresasPorSector("Tec");
echo $result ->message;
*/
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
/*
$controller = new EmpresaController();
$empresa = new Empresa();
$empresa->set("Usuarios_idUsuarios",2);
$empresa->set("EstadoValidacionEmpresa_idEstadoValidacionEmpresa",2);
$empresa->set("nombreEmpresa","Travelnet Actualizado");
$empresa->set("sector","Informatica y redes Actualizado");
$empresa->set("representante","ING Luis Antonio Juarez Ramos Actualizado");
$empresa->set("descripcion","Instalaciones de internet Actualizado");
$empresa->set("sitioWeb","Travelnet.com.mx Actualizado");
$response = $controller->actualizarEmpresas(1, $empresa);
echo $response->message;
*/
/*
$controller = new EmpresaController();
$response = $controller->eliminarEmpresas(2);
echo $response->message;*/
/*
$controller = new EmpresaController();
$response = $controller->buscarEmpresasPorNombre("Travelnet");
echo $response->message;
*/