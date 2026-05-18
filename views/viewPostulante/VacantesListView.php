<?php
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../Dto/Postulaciones.php";
  require_once __DIR__ . "/../../usecase/Postulaciones/PostulacionesController.php";
  require_once __DIR__ . "/../../usecase/Postulantes/PostulantesController.php";

  $vacanteController = new VacanteController();
  $postulacionesController = new PostulacionesController();
  $postulanteController = new PostulantesController();

  $totalVacantes = $vacanteController->contarVacantes();
  $totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
  $totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
  $totalVacantesPausadas = $vacanteController->contarVacantesPausadas();

  $listarVacantesCard = array();
  $resultVacantes = $vacanteController->ListarVacantesTotalesCard();

  if(strtolower($resultVacantes->status) == "ok"){
      $listarVacantesCard = $resultVacantes->body;
  }

  $idUsuario = $_SESSION["idUsuarios"] ?? null;
  $idPostulante = null;
  $vacantesPostuladasMap = [];

  if (!empty($idUsuario)) {
    $resP = $postulanteController->ObtenerPostulantePorIdUsuario($idUsuario);

    if ($resP->status == "ok" && !empty($resP->body)) {
      $idPostulante = (int)(is_array($resP->body)
          ? $resP->body['idPostulante']
          : $resP->body->idPostulante);

      $resVacantesPostuladas = $postulacionesController->ListarVacantesPostuladasPorPostulante($idPostulante);

      if (
        strtolower($resVacantesPostuladas->status) == "ok" &&
        is_array($resVacantesPostuladas->body)
      ) {
        foreach ($resVacantesPostuladas->body as $idVacantePostulada) {
          $vacantesPostuladasMap[(int)$idVacantePostulada] = true;
        }
      }
    }
  }

  // ==========================
  // POSTULARME
  // ==========================
  if(isset($_POST["btnPostularme"])){
    $idVacante = (int)($_POST["idVacantePostular"] ?? 0);
    if (!empty($idPostulante) && !isset($vacantesPostuladasMap[$idVacante])) {
      $postulacionObject = new Postulaciones();
      $postulacionObject->set("Postulante_idPostulante", $idPostulante);
      $postulacionObject->set("Vacante_idVacante", $idVacante);
      $postulacionObject->set("EstadoPostulacion_idEstadoPostulacion", 1);

      $result = $postulacionesController->InsertarPostulacion($postulacionObject);
      if (strtolower($result->status) == 'ok') {
          $vacantesPostuladasMap[$idVacante] = true;
      }
    }
  }

  // ==========================
  // DESPOSTULARME
  // ==========================
  if(isset($_POST["btnDespostularme"])){
    $idVacante = (int)($_POST["idVacanteDespostular"] ?? 0);
    if (!empty($idPostulante) && isset($vacantesPostuladasMap[$idVacante])) {
      $result = $postulacionesController->EliminarPostulacionPorVacanteYPostulante($idPostulante, $idVacante);
      if (strtolower($result->status) == 'ok') {
          unset($vacantesPostuladasMap[$idVacante]);
      }
    }
  }
?>

<link rel="stylesheet" href="css/VacantesListView.css">

<header class="bg-white text-dark py-4 border-bottom">
  <div class="container">
    <!-- Encabezado superior -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1">💼 Vacantes Publicadas Por Empresas</h1>
        <p class="mb-0">Ver las ofertas laborales de las empresas</p>
      </div>
    </div>

    <!-- Tarjetas de estadísticas -->
   <div class="container my-5 text-center">
    <div class="row g-4">
      
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
          <div class="card-body py-4">
            <div class="fs-3 mb-1">📊</div>
            <div class="fw-bold text-secondary small text-uppercase">Total de Vacantes</div>
            <div class="display-6 fw-bold text-dark mt-1"><?php echo htmlspecialchars((string)($totalVacantes->body)); ?></div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
          <div class="card-body py-4">
            <div class="fs-3 mb-1">✅</div>
            <div class="fw-bold text-secondary small text-uppercase">Aprobadas</div>
            <div class="display-6 fw-bold text-dark mt-1"><?php echo htmlspecialchars((string)($totalVacantesAbiertas->body)); ?></div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
          <div class="card-body py-4">
            <div class="fs-3 mb-1">⏳</div>
            <div class="fw-bold text-secondary small text-uppercase">En Pausa</div>
            <div class="display-6 fw-bold text-dark mt-1"><?php echo htmlspecialchars((string)($totalVacantesPausadas->body)); ?></div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
          <div class="card-body py-4">
            <div class="fs-3 mb-1">❌</div>
            <div class="fw-bold text-secondary small text-uppercase">Cerradas</div>
            <div class="display-6 fw-bold text-dark mt-1"><?php echo htmlspecialchars((string)($totalVacantesCerradas->body)); ?></div>
          </div>
        </div>
      </div>

    </div>
</div>
  </div>
</header>

<div class="vacantes-main-container">

<?php if (count($listarVacantesCard) > 0): ?>

  <div class="vacancies-grid">

  <?php foreach ($listarVacantesCard as $vacantes): ?>

    <?php
      $idEstado = (int)($vacantes['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? 0);
      $estadoTexto = strtolower(trim((string)($vacantes['estadoValidacionVacante'] ?? '')));

      if ($idEstado === 0 && $estadoTexto === 'abierta') {
          $idEstado = 1;
      }

      $idVacanteActual = (int)($vacantes['idVacante'] ?? 0);
      $yaPostulado = isset($vacantesPostuladasMap[$idVacanteActual]);
    ?>

    <div class="vacancy-card">
      <div class="card-glow"></div>

      <div class="vacancy-top">
        <div>
          <h2 class="vacancy-title">
            <?php echo htmlspecialchars($vacantes['titulo']); ?>
          </h2>
          <span class="vacancy-id">
            ID #<?php echo htmlspecialchars($vacantes['idVacante']); ?>
          </span>
        </div>
        <span class="status-badge">
          <?php echo htmlspecialchars($vacantes['estadoValidacionVacante']); ?>
        </span>
      </div>

      <div class="vacancy-info">
        <div class="info-item">📍 <?php echo htmlspecialchars($vacantes['ubicacion']); ?></div>
        <div class="info-item">💰 $<?php echo htmlspecialchars($vacantes['salario']); ?></div>
        <div class="info-item">📅 <?php echo htmlspecialchars($vacantes['fechaLimite']); ?></div>
      </div>

      <p class="vacancy-description">
        <?php echo htmlspecialchars($vacantes['descripcion']); ?>
      </p>

      <div class="requirements-box">
        <h4>✨ Requisitos</h4>
        <p><?php echo htmlspecialchars($vacantes['requisitos']); ?></p>
      </div>

      <div class="tags">
        <span class="tag"><?php echo htmlspecialchars($vacantes['estadoContrato']); ?></span>
        <span class="tag"><?php echo htmlspecialchars($vacantes['tipoModalidad']); ?></span>
        <span class="tag salary-tag">$<?php echo htmlspecialchars($vacantes['salario']); ?></span>
      </div>

      <div class="vacancy-footer">
        <span class="published-date">
          🕒 Publicado: <?php echo htmlspecialchars($vacantes['fechaPublicacion']); ?>
        </span>

        <div class="action-buttons">
        <?php if ($idEstado === 1 && !$yaPostulado): ?>
          <form method="POST" action="?cargar=VacantesListView">
            <input type="hidden" name="idVacantePostular" value="<?php echo $idVacanteActual; ?>">
            <button type="submit" name="btnPostularme" class="btn-postular">
              🚀 Postularme
            </button>
          </form>

        <?php elseif ($yaPostulado): ?>
          <div class="already-postulated">✅ Ya postulaste</div>
          <form method="POST" action="?cargar=VacantesListView">
            <input type="hidden" name="idVacanteDespostular" value="<?php echo $idVacanteActual; ?>">
            <button type="submit" name="btnDespostularme" class="btn-despostular">
              ❌ Despostularme
            </button>
          </form>

        <?php else: ?>
          <button type="button" class="btn-disabled" disabled>Vacante Cerrada</button>
        <?php endif; ?>
        </div>
      </div>

    </div>

  <?php endforeach; ?>

  </div>

<?php else: ?>

  <div class="empty-state">
    <div class="empty-icon">📭</div>
    <h2>No hay vacantes disponibles</h2>
    <p>Actualmente no existen vacantes publicadas.</p>
  </div>

<?php endif; ?>

</div>