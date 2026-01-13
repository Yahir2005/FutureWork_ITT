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

    public function ActualizarVacante($id, $vacantes): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ActualizarVacante($id, $vacantes);
    }

    public function EliminarVacante($id): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->EliminarVacante($id);
    }

    public function ListarVacantes(): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ListarVacantes();
    }

    public function ListarVacantesPorNombre($nombre): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ListarVacantesPorNombre($nombre);
    }

    public function ListarVacantesPorEmpresa($idEmpresa): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ListarVacantesPorEmpresa($idEmpresa);
    }

    public function ListarVacantesPorEstadoEmpresaContrato($idEstado): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ListarVacantesPorEstadoEmpresaContrato($idEstado);
    }

    public function ContarCandidatosPorVacante($idVacante): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ContarCandidatosPorVacante($idVacante);
    }

    public function contarVacantes():RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantes();
    }

    public function contarVacantesAbiertas():RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesAbiertas();
    }


    public function contarVacantesCerradas():RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesCerradas();
    }

    public function contarVacantesPausadas():RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesPausadas();
    }

    public function ListarVacantesTotalesCard(): RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->ListarVacantesTotalesCard();
    }

    public function contarVacantesAbiertasPorEmpresa($idEmpresa):RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesAbiertasPorEmpresa($idEmpresa);
    }

    public function contarVacantesCerradasPorEmpresa($idEmpresa):RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesCerradasPorEmpresa($idEmpresa);
    }

    public function contarVacantesPausadasPorEmpresa($idEmpresa):RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesPausadasPorEmpresa($idEmpresa);
    }

    public function contarVacantesPorEmpresa($idEmpresa):RespuestaGenerica{
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->contarVacantesPorEmpresa($idEmpresa);
    }

        public function obtenerVacanteporId($id): RespuestaGenerica
    {
        $gatewayDb = new VacanteGateway();
        $usecase = new VacanteUseCase($gatewayDb);
        return $usecase->obtenerVacanteporId($id);
    }


}
/*
$controller = new VacanteController();
$result = $controller->contarVacantesPorEmpresa(1);
echo $result->body;
*/
/*
$controller = new VacanteController();
$result = $controller->contarVacantesPausadasPorEmpresa(1);
echo $result->body;
*/
/*
$controller = new VacanteController();
$result = $controller->contarVacantesCerradasPorEmpresa(1);
echo $result->body;
*/
/*
$controller = new vacanteController();
$result = $controller->contarVacantesAbiertasPorEmpresa(1);
echo $result->body;
*/
/*
$controller = new VacanteController();
$result = $controller->contarVacantes();
echo $result->body;
*/
/*
$controller = new VacanteController();
$result = $controller->ContarCandidatosPorVacante(1);
echo $result->message;
*/
/*
$controller = new VacanteController();
$result = $controller->ListarVacantesPorEstadoEmpresaContrato(1);
echo $result->message;
*/
/*
$controller = new VacanteController();
$response = $controller->ListarVacantesPorEmpresa(1);
echo $response->message;
*/
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
/*
$controller = new VacanteController();
$response = $controller->ListarVacantesPorNombre("Desarrollador");

$listar= array();
$listar = $response->body;
foreach($listar as $row){
    echo $row['titulo']; 
}
echo $response->message;
*/
/*
$controller = new VacanteController();
$response = $controller->ListarVacantes();
echo $response->message;
*/
/*
$controller = new VacanteController();
$objectVacante = new Vacantes();
$objectVacante->set("Empresa_idEmpresa",1);
$objectVacante->set("EstadoValidacionVacante_idEstadoValidacionVacante",2);
$objectVacante->set("TipoContrato_idTipoContrato",3);
$objectVacante->set("TipoModalidad_idTipoModalidad",2);
$objectVacante->set("titulo","Desarrollador PHP Senior");
$objectVacante->set("descripcion","Se busca desarrollador PHP con experiencia avanzada");
$objectVacante->set("requisitos","PHP, MySQL, JavaScript, Laravel");
$objectVacante->set("ubicacion","Ciudad de México");
$objectVacante->set("salario",25000.00);
$objectVacante->set("fechaLimite","2025-01-31");
$response = $controller->ActualizarVacante(4,$objectVacante);
echo $response->message;*/
/*
$controller = new VacanteController();
$response = $controller->EliminarVacante(4);
echo $response->message;
*/