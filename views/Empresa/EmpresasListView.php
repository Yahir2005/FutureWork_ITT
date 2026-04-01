<?php

    // muestra el valor
    require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
    require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';
    require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';

    /*Arrays*/
    $listarValidaciones = array();
    $listarEmpresas = array();
        
    /**Controller */
    $estadoValidacionEmpresaController = new EstadoValidacionEmpresaController();
    $controllerEmpresa = new EmpresaController();

    /*resultListar */
    $resultValidaciones = $estadoValidacionEmpresaController->ListarValidacionesEmpresa();
    $resultEmpresas = $controllerEmpresa->listarEmpresas(); 
    $resultTotalEmpresa = $controllerEmpresa->contarEmpresas();
    $resultTotalEmpresaPendiente = $controllerEmpresa->contarEmpresasPorValidacion(1);
    $resultTotalEmpresasValida = $controllerEmpresa->contarEmpresasPorValidacion(2);
    $resultTotalEmpresaRechazado = $controllerEmpresa->contarEmpresasPorValidacion(3);

    /**listar */
    if(strtolower($resultValidaciones->status) == "ok"){
        foreach($resultValidaciones->body as $estado){
            $listarValidaciones[$estado["idEstadoValidacionEmpresa"]] = $estado["estadoValidacionEmpresa"];
        }
    }
    
    if(strtolower($resultEmpresas->status) == "ok" && is_array($resultEmpresas->body)){
      $listarEmpresas = $resultEmpresas->body;
    }

?>
<header class="bg-primary text-white py-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1">🏢 Ver Empresas</h1>
        <p class="mb-0">Ver Empresas Registradas</p>
      </div>
    </div>

    <div class="row text-center text-dark">
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold text-muted">📊 Total Empresas</div>
            <div class="display-6"><?php echo $totalEmpresas ?? 0; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold text-success">✅ Validadas</div>
            <div class="display-6"><?php echo $totalValidadas ?? 0; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold text-warning">⏳ Pendientes</div>
            <div class="display-6"><?php echo $totalPendientes ?? 0; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold text-danger">❌ Rechazadas</div>
            <div class="display-6"><?php echo $totalRechazadas ?? 0; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="p-5">
<?php if (!empty($listarEmpresas) && count($listarEmpresas) > 0): ?>
  <div class="row">
    <?php foreach ($listarEmpresas as $empresa): ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex flex-column">
            
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div>
                <h4 class="card-title mb-1 fw-bold">
                  <?php echo htmlspecialchars($empresa['nombreEmpresa']); ?>
                </h4>
                <small class="text-muted">ID: #<?php echo htmlspecialchars($empresa['idEmpresas'] ?? 'N/A'); ?></small>
              </div>

              <?php 
                // Lógica del Badge de estado
                $idEstado = (int)($empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa'] ?? 0);
                $nombreEstado = $listarValidaciones[$idEstado] ?? 'Desconocido';
                $estadoTexto = strtolower(trim((string)$nombreEstado));

                $badgeClass = 'bg-secondary';
                if ($idEstado === 1 || str_contains($estadoTexto, 'pend')) $badgeClass = 'bg-warning text-dark';
                if ($idEstado === 2 || str_contains($estadoTexto, 'vali') || str_contains($estadoTexto, 'apro')) $badgeClass = 'bg-success';
                if ($idEstado === 3 || str_contains($estadoTexto, 'rech')) $badgeClass = 'bg-danger';
              ?>
              <span class="badge <?php echo $badgeClass; ?>">
                <?php echo htmlspecialchars($nombreEstado); ?>
              </span>
            </div>
              
            <ul class="list-unstyled mb-3">
              <li><strong>🏭 Sector:</strong> <?php echo htmlspecialchars($empresa['sector']); ?></li>
              <li><strong>👤 Representante:</strong> <?php echo htmlspecialchars($empresa['representante']); ?></li>
              <li class="text-truncate">
                <strong>🌐 Web:</strong> 
                <?php if(!empty($empresa['sitioWeb'])): ?>
                  <a href="<?php echo htmlspecialchars($empresa['sitioWeb']); ?>" target="_blank" class="text-decoration-none">
                    <?php echo htmlspecialchars($empresa['sitioWeb']); ?>
                  </a>
                <?php else: ?>
                  <span class="text-muted">No especificado</span>
                <?php endif; ?>
              </li>
            </ul>

            <div class="flex-grow-1 mb-3">
              <p class="small mb-0"><strong>Descripción:</strong></p>
              <p class="card-text small text-muted">
                <?php echo nl2br(htmlspecialchars($empresa['descripcion'])); ?>
              </p>
            </div>

            <div class="mt-auto pt-3 border-top">
              <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="?cargar=EmpresaDetalleView&id=<?php echo $empresa['idEmpresas'] ?? 0; ?>" class="btn btn-sm btn-outline-info flex-grow-1">👁️ Detalles</a>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="alert alert-info" role="alert">
    No hay empresas registradas por el momento.
  </div>
<?php endif; ?>
</div>