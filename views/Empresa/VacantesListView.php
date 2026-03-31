<?php
    require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

    /*Controllers*/
    $vacanteController = new VacanteController();

    /**Contar total de vacantes */
    $totalVacantes = $vacanteController->contarVacantes();
    $totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
    $totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
    $totalVacantesPausadas = $vacanteController->contarVacantesPausadas();

    // --- Empresas ---
    $listarVacantesCard = array();
    $resultVacantes = $vacanteController->ListarVacantesTotalesCard() ;
    if(strtolower($resultVacantes->status) == "ok"){
    $listarVacantesCard = $resultVacantes->body;
    }
?>

<header class="bg-primary text-white py-4">
  <div class="container">
    <!-- Encabezado superior -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1">💼 Vacantes Publicadas Por Empresas</h1>
        <p class="mb-0">Ver las ofertas laborales de las empresas</p>
      </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row text-center">
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">📊 Total de Vacantes</div>
            <div class="display-6"><?php echo $totalVacantes->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">✅ Aprobadas</div>
            <div class="display-6"><?php echo $totalVacantesAbiertas->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">⏳ En Pausa</div>
            <div class="display-6"><?php echo $totalVacantesPausadas->body; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">❌ Rechazadas/Cerradas</div>
            <div class="display-6"><?php echo $totalVacantesCerradas->body; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="p-5">
<?php if (count($listarVacantesCard) > 0): ?>
  <div class="row">
    <?php foreach ($listarVacantesCard as $vacante): ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex flex-column">
            <!-- Encabezado -->
            <div class="d-flex justify-content-between align-items-start mb-2">
              <div>
                <h5 class="card-title mb-1">
                  <?php echo htmlspecialchars($vacante['titulo']); ?>
                </h5>
                <small class="text-muted">ID: #<?php echo htmlspecialchars($vacante['idVacante'] ?? 'N/A'); ?></small>
              </div>
              <span class="badge bg-primary">
                <?php echo htmlspecialchars($vacante['estadoValidacionVacante']); ?>
              </span>
            </div>

            <!-- Detalles -->
            <ul class="list-unstyled mb-3">
              <li><strong>📍 Ubicación:</strong> <?php echo htmlspecialchars($vacante['ubicacion']); ?></li>
              <li><strong>💰 Salario:</strong> $<?php echo htmlspecialchars($vacante['salario']); ?></li>
              <li><strong>📅 Límite:</strong> <?php echo htmlspecialchars($vacante['fechaLimite']); ?></li>
            </ul>

            <!-- Descripción -->
            <p class="card-text flex-grow-1">
              <?php echo htmlspecialchars($vacante['descripcion']); ?>
            </p>
            <p class="small"><strong>* Requisitos:</strong><br><?php echo htmlspecialchars($vacante['requisitos']); ?></p>

            <!-- Tags -->
            <div class="mb-3">
              <span class="badge bg-success"><?php echo htmlspecialchars($vacante['estadoContrato']); ?></span>
              <span class="badge bg-info text-dark"><?php echo htmlspecialchars($vacante['tipoModalidad']); ?></span>
            </div>

            <!-- Footer -->
            <div class="d-flex justify-content-between align-items-center mt-auto">
              <small class="text-muted">📅 Publicado: <strong><?php echo htmlspecialchars($vacante['fechaPublicacion']); ?></strong></small>
              <div class="btn-group">
                <a href="?cargar=VacantePostulantes&id=<?php echo $vacante['idVacante'] ?? 0; ?>" class="btn btn-sm btn-outline-primary">Ver Postulantes</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php else: ?>
  <div class="alert alert-info mt-4" role="alert">
    No hay vacantes publicadas por el momento.
  </div>
<?php endif; ?>