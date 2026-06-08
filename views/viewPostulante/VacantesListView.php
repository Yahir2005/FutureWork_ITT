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

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <!-- Stats Cards -->
      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-label">
            📊 Total de Vacantes
          </div>
          <div class="stat-value">
            <?php echo htmlspecialchars($totalVacantes->body ?? 0); ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ✅ Vacantes Abiertas
          </div>
          <div class="stat-value">
            <?php echo htmlspecialchars($totalVacantesAbiertas->body ?? 0); ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ❌ Vacantes Cerradas
          </div>
          <div class="stat-value">
            <?php echo htmlspecialchars($totalVacantesCerradas->body ?? 0); ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ⏸️ Vacantes Pausadas
          </div>
          <div class="stat-value">
            <?php echo htmlspecialchars($totalVacantesPausadas->body ?? 0); ?>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Container -->
  <main class="container">

    <!-- Vacancies Grid -->
    <div class="vacancies-grid">
      <?php if (count($listarVacantesCard) > 0): ?>
        <?php foreach ($listarVacantesCard as $vacante): ?>
          <?php
            // Extraer datos de la vacante
            $idVacante = (int)($vacante['idVacante'] ?? 0);
            $titulo = htmlspecialchars($vacante['titulo'] ?? 'Sin título');
            $descripcion = htmlspecialchars($vacante['descripcion'] ?? 'Sin descripción');
            $ubicacion = htmlspecialchars($vacante['ubicacion'] ?? 'No especificada');
            $salario = htmlspecialchars($vacante['salario'] ?? 'Por convenir');
            $fechaLimite = htmlspecialchars($vacante['fechaLimite'] ?? 'No especificada');
            $requisitos = htmlspecialchars($vacante['requisitos'] ?? 'No especificados');
            $estadoValidacion = htmlspecialchars($vacante['estadoValidacionVacante'] ?? 'Pendiente');
            $estadoContrato = htmlspecialchars($vacante['estadoContrato'] ?? 'No especificado');
            $tipoModalidad = htmlspecialchars($vacante['tipoModalidad'] ?? 'No especificado');
            $fechaPublicacion = htmlspecialchars($vacante['fechaPublicacion'] ?? 'Recientemente');
            
            // Verificar si ya postulé
            $yaPostulado = isset($vacantesPostuladasMap[$idVacante]);
            
            // Determinar estado de la vacante (1=Abierta, 2=Cerrada, 3=Pausada)
            $idEstado = (int)($vacante['idEstado'] ?? 2);
          ?>

          <!-- Vacancy Card -->
          <div class="vacancy-card">
            <div class="vacancy-header">
              <div class="vacancy-title">
                <h3><?php echo $titulo; ?></h3>
                <div class="vacancy-id">ID: <?php echo $idVacante; ?></div>
              </div>
              <span class="tag contract"><?php echo $estadoValidacion; ?></span>
            </div>

            <div class="vacancy-details">
              <div class="detail-item">📍 Ubicación: <?php echo $ubicacion; ?></div>
              <div class="detail-item">💰 Salario: $<?php echo $salario; ?></div>
              <div class="detail-item">📅 Límite: <?php echo $fechaLimite; ?></div>
            </div>

            <p class="vacancy-description">
              <?php echo $descripcion; ?>
            </p>

            <div class="vacancy-footer">
              <div class="detail-item">
                * Requisitos: <br/>
                <?php echo $requisitos; ?>
              </div>
            </div>

            <br />

            <div class="vacancy-tags">
              <span class="tag contract"><?php echo $estadoContrato; ?></span>
              <span class="tag modality"><?php echo $tipoModalidad; ?></span>
              <span class="tag salary">$<?php echo $salario; ?></span>
            </div>

            <div class="vacancy-footer">
              <span class="published-date">
                🕒 Publicado: <?php echo $fechaPublicacion; ?>
              </span>

              <div class="action-buttons">
                <?php if ($idEstado === 1 && !$yaPostulado): ?>
                  <!-- Vacante Abierta y No Postulado -->
                  <form method="POST" action="">
                    <input type="hidden" name="idVacantePostular" value="<?php echo $idVacante; ?>">
                    <button type="submit" name="btnPostularme" class="btn-postular">
                      🚀 Postularme
                    </button>
                  </form>

                <?php elseif ($yaPostulado): ?>
                  <!-- Ya Postulado -->
                  <div class="already-postulated">✅ Ya postulaste</div>
                  <form method="POST" action="">
                    <input type="hidden" name="idVacanteDespostular" value="<?php echo $idVacante; ?>">
                    <button type="submit" name="btnDespostularme" class="btn-despostular">
                      ❌ Despostularme
                    </button>
                  </form>

                <?php else: ?>
                  <!-- Vacante Cerrada o Pausada -->
                  <button type="button" class="btn-disabled" disabled>
                    <?php 
                      if ($idEstado === 2) {
                        echo 'Vacante Cerrada';
                      } elseif ($idEstado === 3) {
                        echo 'Vacante Pausada';
                      } else {
                        echo 'No Disponible';
                      }
                    ?>
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <!-- Empty State -->
        <div class="empty-state">
          <div class="empty-state-icon">
            📭
          </div>
          <h3>No se han encontrado vacantes publicadas</h3>
          <p>No hay vacantes disponibles en este momento.</p>
        </div>
      <?php endif; ?>
    </div>

  </main>

  <!-- Estilos adicionales para botones de acción -->
  <style>
    .action-buttons {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items: center;
    }

    .action-buttons form {
      display: contents;
    }

    .btn-postular,
    .btn-despostular {
      padding: 10px 20px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-postular:hover,
    .btn-despostular:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .btn-despostular {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }

    .btn-despostular:hover {
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-disabled {
      padding: 10px 20px;
      background: #6c757d;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: not-allowed;
      opacity: 0.6;
    }

    .already-postulated {
      padding: 10px 20px;
      background: #d4edda;
      color: #155724;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      display: flex;
      align-items: center;
    }
  </style>

  <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'9a1535ac6670b1f2',t:'MTc2MzYxMzAwMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
</body>

</html>