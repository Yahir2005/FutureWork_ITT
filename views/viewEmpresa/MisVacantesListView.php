<?php
  // Session validation
  if (!isset($_SESSION["idUsuarios"])) {
    echo "<div class='alert alert-danger' role='alert'>✗ Error: No hay sesión activa. Por favor inicia sesión.</div>";
    exit;
  }

  $MessageID = "";
  $idUsuario = $_SESSION["idUsuarios"];
  /** Ruta del controlador */
  require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';
  require_once __DIR__ . '/../../usecase/Usuario/UsuarioController.php';
  /** Instancias */
  $vacanteController = new VacanteController();
  $usuarioController = new UsuarioController();
  /**Arrays */
  $vacanteArray = array();
  /**resultListar*/
  
  $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
  /**listar */
  
  if ($result->status == "ok") {
    
    $datos = $result->body;

    $idEmpresa = $datos['empresaId'];

    $resultListarVacantes = $vacanteController->ListarVacantesPorEmpresa($idEmpresa);
    if($resultListarVacantes->status == "ok"){
      $vacanteArray = $resultListarVacantes->body;
    }

  } else {
    // Manejo de errores
    echo "<div class='alert alert-danger' role='alert'>✗ Error al registrar: ".$result->message."</div>";
  }

  $total = count($vacanteArray); 
  $aprobadas = count(array_filter($vacanteArray, fn($v) => $v['EstadoValidacionVacante_idEstadoValidacionVacante'] == 1)); 
  $pendientes = count(array_filter($vacanteArray, fn($v) => $v['EstadoValidacionVacante_idEstadoValidacionVacante'] == 2)); 
  $rechazadas = count(array_filter($vacanteArray, fn($v) => $v['EstadoValidacionVacante_idEstadoValidacionVacante'] == 3));
?>
<div class="vacancies-grid">
  <?php if (!empty($vacanteArray)) : ?>
    <?php foreach ($vacanteArray as $vacante) : ?>
      <div class="vacancy-card">
        <div class="vacancy-header">
          <div class="vacancy-title">
            <h3><?= htmlspecialchars($vacante['titulo']) ?></h3>
            <div class="vacancy-id">ID: #<?= $vacante['idVacante'] ?></div>
          </div>
          <span class="validation-status 
            <?= $vacante['EstadoValidacionVacante_idEstadoValidacionVacante'] == 1 ? 'status-aprobada' : 
               ($vacante['EstadoValidacionVacante_idEstadoValidacionVacante'] == 2 ? 'status-pendiente' : 'status-rechazada') ?>">
            <?= $vacante['EstadoValidacionVacante_idEstadoValidacionVacante'] == 1 ? '✓ Aprobada' : 
               ($vacante['EstadoValidacionVacante_idEstadoValidacionVacante'] == 2 ? '⏳ Pendiente' : '❌ Rechazada') ?>
          </span>
        </div>

        <div class="vacancy-details">
          <div class="detail-item">
            <span class="detail-label">Ubicación</span>
            <span class="detail-value">📍 <?= htmlspecialchars($vacante['ubicacion']) ?></span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Salario</span>
            <span class="detail-value salary">💰 $<?= number_format($vacante['salario'], 2) ?></span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Tipo Contrato</span>
            <span class="detail-value">📝 <?= $vacante['TipoContrato'] ?></span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Modalidad</span>
            <span class="detail-value">💻 <?= $vacante['TipoModalidad'] ?></span>
          </div>
        </div>

        <p class="vacancy-description">
          <?= nl2br(htmlspecialchars($vacante['descripcion'])) ?>
        </p>

        <div class="vacancy-footer">
          <div class="dates-info">
            <div class="date-item">
              📅 Publicado: <strong><?= date("d/m/Y", strtotime($vacante['fechaPublicacion'])) ?></strong>
            </div>
            <div class="date-item">
              ⏰ Límite: <strong><?= date("d/m/Y", strtotime($vacante['fechaLimite'])) ?></strong>
            </div>
          </div>
          <div class="vacancy-actions">
            <a href="detalle-vacante.php?id=<?= $vacante['idVacante'] ?>" class="btn-details">👁️ Ver Detalles</a>
            <a href="editar-vacante.php?id=<?= $vacante['idVacante'] ?>" class="btn-edit">✏️ Editar</a>
            <a href="eliminar-vacante.php?id=<?= $vacante['idVacante'] ?>" class="btn-delete">🗑️ Eliminar</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="empty-state">
      <div class="empty-state-icon">📭</div>
      <h3>Tu empresa no tiene vacantes publicadas</h3>
      <p>Comienza a publicar ofertas laborales de tu empresa y encuentra a los mejores candidatos.</p>
      <a href="agregar-vacante.html" class="btn-add">➕ Publicar Primera Vacante de la Empresa</a>
    </div>
  <?php endif; ?>
</div>