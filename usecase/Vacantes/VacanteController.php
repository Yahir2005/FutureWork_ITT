<?php
require_once __DIR__ ."/VacanteGateway.php";
require_once __DIR__ ."/VacanteUseCase.php";
require_once __DIR__ ."/../../Dto/Vacantes.php";

class VacanteController{
    public function InsertarVacante(Vacantes $vacantes):RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->InsertarVacante($vacantes);
    }
}
/*
$controller = new VacanteController();
$vacanteObject = new Vacantes();
$vacanteObject->set("Empresa_idEmpresa",1);
$vacanteObject->set("EstadoValidacionVacante_idEstadoValidacionVacante",2);
$vacanteObject->set("TipoContrato_idTipoContrato",3);
$vacanteObject->set("TipoModalidad_idTipoModalidad",2);
$vacanteObject->set("titulo","Desarrollador PHP");
$vacanteObject->set("descripcion","Se busca desarrollador PHP con experiencia");
$vacanteObject->set("requisitos","PHP, MySQL, JavaScript");
$vacanteObject->set("ubicacion","Ciudad de México");
$vacanteObject->set("salario",15000.00);
$vacanteObject->set("fechaLimite","2024-12-31");
$response = $controller->InsertarVacante($vacanteObject);
echo $response->message;
*/