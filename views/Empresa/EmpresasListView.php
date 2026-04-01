<?php

    // muestra el valor
    require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
    require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';
    require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';

    /*Arrays*/
    $listarValidaciones = array();
    $listarEmpresas = array();
    $listar = array();
        
    /**Controller */
    $estadoValidacionEmpresaController = new EstadoValidacionEmpresaController();
    $controllerEmpresa = new EmpresaController();

    /*resultListar */
    $resultValidaciones = $estadoValidacionEmpresaController->ListarValidacionesEmpresa();
    $resultEmpresas = $controllerEmpresa->listarEmpresas(); 
    $resultTotalEmpresaPendiente = $controllerEmpresa->contarEmpresasPorValidacion(1);
    $resultTotalEmpresasValida = $controllerEmpresa->contarEmpresasPorValidacion(2);
    $resultTotalEmpresaRechazado = $controllerEmpresa->contarEmpresasPorValidacion(3);

    /**listar */
    if(strtolower($resultValidaciones->status) == "ok"){
        foreach($resultValidaciones->body as $estado){
            $listarValidaciones[$estado["idEstadoValidacionEmpresa"]] = $estado["estadoValidacionEmpresa"];
        }
    }
    
    if(strtolower($resultEmpresas->status) == "ok"){
    $listar = $resultEmpresas->body;
    }

?>
<header class="bg-primary text-white py-4">
  <div class="container">
    <!-- Encabezado superior -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1">🏢 Empresas</h1>
        <p class="mb-0">Ver las empresas</p>
      </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row text-center">
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">📊 Total de Empresas</div>
            <div class="display-6"><?php echo $resultEmpresas->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">✅ Validadas</div>
            <div class="display-6"><?php echo $resultTotalEmpresasValida->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">⏳ Pendientes</div>
            <div class="display-6"><?php echo $resultTotalEmpresaPendiente->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">❌ Rechazadas</div>
            <div class="display-6"><?php echo $resultTotalEmpresaRechazado->body; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>