<?php
    require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
    require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';
    require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';

    // --- Validaciones ---
    $listarValidaciones = array();
    $estadoValidacionEmpresaController = new EstadoValidacionEmpresaController();
    $resultValidaciones = $estadoValidacionEmpresaController->ListarValidacionesEmpresa();
    if(strtolower($resultValidaciones->status) == "ok"){
    foreach($resultValidaciones->body as $estado){
        $listarValidaciones[$estado["idEstadoValidacionEmpresa"]] = $estado["estadoValidacionEmpresa"];
    }
    }

    // --- Empresas ---
    $controller = new EmpresaController();
    $listar = array();
    $resultEmpresas = $controller->listarEmpresas(); 
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
            <div class="display-6"><?php echo $totalEmpresas->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">✅ Validadas</div>
            <div class="display-6"><?php echo $totalEmpresasValidadas->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">⏳ Pendientes/div>
            <div class="display-6"><?php echo $totalEmpresasPendientes->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">❌ Rechazadas</div>
            <div class="display-6"><?php echo $totalVacantesCerradas->body; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>