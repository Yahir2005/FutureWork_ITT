<?php
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Postulantes/PostulanteController.php";
require_once __DIR__ . "/../../usecase/Postulaciones/PostulacionesController.php";
require_once __DIR__ . "/../../usecase/Postulaciones/Postulaciones.php";

$vacanteController = new VacanteController();
$postulanteController = new PostulanteController();
$postulacionesController = new PostulacionesController();

/**Contar total de vacantes */
$totalVacantes = $vacanteController->contarVacantes();
$totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
$totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
$totalVacantesPausadas = $vacanteController->contarVacantesPausadas();

// --- Empresas ---
$listarVacantesCard = array();
$resultVacantes = $vacanteController->ListarVacantesTotalesCard();
if (strtolower($resultVacantes->status) == "ok") {
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
if (isset($_POST["btnPostularme"])) {
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
if (isset($_POST["btnDespostularme"])) {
  $idVacante = (int)($_POST["idVacanteDespostular"] ?? 0);
  if (!empty($idPostulante) && isset($vacantesPostuladasMap[$idVacante])) {
    $result = $postulacionesController->EliminarPostulacionPorVacanteYPostulante($idPostulante, $idVacante);
    if (strtolower($result->status) == 'ok') {
        unset($vacantesPostuladasMap[$idVacante]);
    }
  }
}

?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Vacantes de Empresa</title>
  <link rel="stylesheet" href="css/VacantesListView.css">
  <style>
    @view-transition {
      navigation: auto;
    }
  </style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body><!-- Header -->
  <header class="header">
    <div class="header-content"><!-- Stats Cards -->
      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-label">
            📊 Total de Vacantes
          </div>
          <div class="stat-value">
            <?php echo $totalVacantes->body ?? 0 ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ✅ Vacantes Abiertas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesAbiertas->body ?? 0 ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ❌ Vacantes Cerradas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesCerradas->body ?? 0 ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ⏸️ Vacantes Pausadas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesPausadas->body ?? 0 ?>
          </div>
        </div>
      </div>
    </div>
  </header><!-- Main Container -->
  <main class="container">

    <!-- Vacancies Grid -->
    <div class="vacancies-grid">
<?php if (count($listarVacantesCard) > 0): ?>
  <?php foreach ($listarVacantesCard as $vacantes): ?>
    <?php
      $idVacante = (int)($vacantes['idVacante'] ?? 0);
      $yaPostulado = isset($vacantesPostuladasMap[$idVacante]);
      $idEstado = (int)($vacantes['idEstado'] ?? 2);
    ?>
    <div class="vacancy-card">
      <div class="vacancy-header">
        <div class="vacancy-title">
          <h3><?php echo htmlspecialchars($vacantes['titulo']); ?></h3>
          <div class="vacancy-id">ID: <?php echo $idVacante; ?></div>
        </div>
        <span class="tag contract"><?php echo htmlspecialchars($vacantes['estadoValidacionVacante']); ?></span>
      </div>

      <div class="vacancy-details">
        <div class="detail-item">📍 Ubicación: <?php echo htmlspecialchars($vacantes['ubicacion']); ?></div>
        <div class="detail-item">💰 Salario: $ <?php echo htmlspecialchars($vacantes['salario']); ?></div>
        <div class="detail-item">📅 Límite: <?php echo htmlspecialchars($vacantes['fechaLimite']); ?></div>
      </div>
      <p class="vacancy-description">
        <?php echo htmlspecialchars($vacantes['descripcion']); ?>
      </p>
      <div class="vacancy-footer">
        <div class="detail-item">* Requisitos: <br /><?php echo htmlspecialchars($vacantes['requisitos']); ?></div>
      </div>
      <br />
      <div class="vacancy-tags">
        <span class="tag contract"><?php echo htmlspecialchars($vacantes['estadoContrato']); ?></span>
        <span class="tag modality"><?php echo htmlspecialchars($vacantes['tipoModalidad']); ?></span>
        <span class="tag salary">$ <?php echo htmlspecialchars($vacantes['salario']); ?></span>
      </div>

      <div class="vacancy-footer">
        <span class="published-date">
          🕒 Publicado: <?php echo htmlspecialchars($vacantes['fechaPublicacion']); ?>
        </span>

        <div class="action-buttons">
        <?php if ($idEstado === 1 && !$yaPostulado): ?>
          <form method="POST" action="">
            <input type="hidden" name="idVacantePostular" value="<?php echo $idVacante; ?>">
            <button type="submit" name="btnPostularme" class="btn-postular">
              🚀 Postularme
            </button>
          </form>

        <?php elseif ($yaPostulado): ?>
          <div class="already-postulated">✅ Ya postulaste</div>
          <form method="POST" action="">
            <input type="hidden" name="idVacanteDespostular" value="<?php echo $idVacante; ?>">
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
<?php else: ?>
  <div class="empty-state">
    <div class="empty-state-icon">
      📭
    </div>
    <h3>No se han encontrado vacantes publicadas</h3>
    <p>No hay vacantes disponibles.</p>
  </div>
<?php endif; ?>
    </div>

  </main>
  <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'9a1535ac6670b1f2',t:'MTc2MzYxMzAwMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
</body>

</html>