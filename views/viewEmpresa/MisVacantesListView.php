<?php
// Vista: MisVacantesListView
// Esta vista está pensada para ser incluida dentro de la plantilla/navbarEmpresa.php
// y mostrar las vacantes pertenecientes a la empresa actualmente autenticada.

// Conectar con el manejador de sesión y el controlador de vacantes.
// Descomenta y ajusta las rutas si tu proyecto tiene esos archivos.
// 
// require_once __DIR__ . "/../../usecase/Vacante/VacanteController.php";

// // Verificar sesión (opcional, la plantilla que incluye esta vista suele manejarla)
// if(!SessionManager::isUserLoggedIn() || SessionManager::getRoleId() != 1) {
//     header("Location: ../index.php");
//     exit;
// }

// // Obtener vacantes de la empresa
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
  require_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";
  $idEmpresa = SessionManager::getUserId(); 
  $controllerVacantes = new VacanteController();
  $controllerEstado = new EstadoValidacionVacanteController();
  $result = $controllerVacantes->ListarVacantesPorEmpresa($idEmpresa); 
  $vacantes = array();
   // Obtener datos
  if($result->status == "ok"){
    $vacantes = $result->body;
  }else{
    echo "<div class='alert alert-danger' role='alert'>Error al obtener las vacantes: ".$result->message."</div>";
  }


?>

<!-- Contenido principal (fragmento para incluir dentro de navbarEmpresa.php) -->
<main class="main-content" style="padding-top: 30px; padding-bottom: 60px;">
  <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:24px;">
    <div>
      <h1 style="color:#fff; font-size:28px; margin-bottom:6px;">📋 Mis Vacantes</h1>
      <p style="color:#fff;">Administra las vacantes que has publicado — revisa candidatos, edita o elimina publicaciones.</p>
    </div>
    <div style="display:flex; gap:12px; align-items:center;">
      <a href="?cargar=VacantesAddView" class="btn-submit" style="padding:10px 18px; border-radius:8px; text-decoration:none; background:linear-gradient(135deg,#1e3c72 0%,#2a5298 100%); color:#fff; font-weight:600;">
        ➕ Publicar nueva vacante
      </a>
    </div>
  </div>

  <!-- Tarjetas de resumen -->
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:18px; margin-bottom:22px;">
    <div style="background:white; padding:18px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); display:flex; gap:12px; align-items:center;">
      <div style="width:56px;height:56px;border-radius:10px;background:#2a5298;color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;">💼</div>
      <div>
        <div style="font-size:20px; font-weight:700; color:#1e3c72;"><?= $totalVacantes ?></div>
        <div style="font-size:13px; color:#777;">Vacantes publicadas</div>
      </div>
    </div>
    <div style="background:white; padding:18px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); display:flex; gap:12px; align-items:center;">
      <div style="width:56px;height:56px;border-radius:10px;background:#388e3c;color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;">✅</div>
      <div>
        <div style="font-size:20px; font-weight:700; color:#1e3c72;"><?= $vacantesAbiertas ?></div>
        <div style="font-size:13px; color:#777;">Vacantes abiertas</div>
      </div>
    </div>
    <div style="background:white; padding:18px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); display:flex; gap:12px; align-items:center;">
      <div style="width:56px;height:56px;border-radius:10px;background:#f57c00;color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
      <div>
        <div style="font-size:20px; font-weight:700; color:#1e3c72;"><?= $totalCandidatos ?></div>
        <div style="font-size:13px; color:#777;">Candidatos totales</div>
      </div>
    </div>
  </div>

  <!-- Buscador -->
  <div style="display:flex; justify-content:flex-end; margin-bottom:12px;">
    <form method="GET" action="" style="display:flex; gap:8px; align-items:center;">
      <input type="hidden" name="cargar" value="MisVacantesListView">
      <input type="search" name="buscar" placeholder="Buscar por título..." style="padding:10px 12px; border:2px solid #e0e0e0; border-radius:8px; min-width:260px;">
      <button type="submit" style="padding:10px 14px; border-radius:8px; background:#1e3c72; color:white; border:none; font-weight:600;">🔎 Buscar</button>
    </form>
  </div>

  <!-- Tabla de vacantes -->
  <div style="background:white; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.05); overflow:auto;">
    <table style="width:100%; border-collapse:collapse; min-width:900px;">
      <thead style="background:#f8f9fa;">
        <tr>
          <th style="text-align:left; padding:14px 18px; font-size:13px; color:#666;">Título</th>
          <th style="text-align:left; padding:14px 18px; font-size:13px; color:#666;">Publicado</th>
          <th style="text-align:left; padding:14px 18px; font-size:13px; color:#666;">Modalidad / Contrato</th>
          <th style="text-align:center; padding:14px 18px; font-size:13px; color:#666;">Candidatos</th>
          <th style="text-align:center; padding:14px 18px; font-size:13px; color:#666;">Estatus</th>
          <th style="text-align:center; padding:14px 18px; font-size:13px; color:#666;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($vacantes)): ?>
          <?php foreach ($vacantes as $vac): ?>
            <tr>
              <td style="padding:14px 18px; vertical-align:middle;">
                <div style="font-weight:700; color:#1e3c72;"><?= htmlspecialchars($vac['titulo']) ?></div>
                <div style="font-size:13px; color:#777; max-width:520px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                  <?= htmlspecialchars($vac['descripcion']) ?>
                </div>
              </td>
              <td style="padding:14px 18px; vertical-align:middle;"><?= date("d/m/Y", strtotime($vac['fechaPublicacion'])) ?></td>
              <td style="padding:14px 18px; vertical-align:middle;"><?= htmlspecialchars($vac['TipoModalidad']) ?> / <?= htmlspecialchars($vac['tipoContrato']) ?></td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle; font-weight:700; color:#1976d2;"><?= $vac['candidatos'] ?></td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle;">
                <?php
                  $estatus = strtolower($vac['estatus']);
                  $badgeStyle = match ($estatus) {
                    'abierta' => 'background:#e8f5e9;color:#388e3c;padding:6px 12px;border-radius:18px;font-weight:700;',
                    'cerrada' => 'background:#ffebee;color:#c62828;padding:6px 12px;border-radius:18px;font-weight:700;',
                    'pausada' => 'background:#fff7e6;color:#f57c00;padding:6px 12px;border-radius:18px;font-weight:700;',
                    default => 'background:#f0f0f0;color:#666;padding:6px 12px;border-radius:18px;font-weight:700;'
                  };
                ?>
                <span style="<?= $badgeStyle ?>"><?= htmlspecialchars($vac['estatus']) ?></span>
              </td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle;">
                <div style="display:flex; gap:8px; justify-content:center; flex-wrap:wrap;">
                  <button onclick="location.href='?cargar=CandidatosListView&id=<?= $vac['idVacante'] ?>'" style="padding:8px 10px; border-radius:8px; border:none; background:#e3f2fd; color:#1976d2; cursor:pointer;">👥 Candidatos</button>
                  <button onclick="location.href='?cargar=VacantesUpdateView&id=<?= $vac['idVacante'] ?>'" style="padding:8px 10px; border-radius:8px; border:none; background:#fff3e0; color:#f57c00; cursor:pointer;">✏️ Editar</button>
                  <button onclick="confirmarEstado(<?= $vac['idVacante'] ?>,'<?= $vac['estatus'] ?>')" style="padding:8px 10px; border-radius:8px; border:none; background:#fff7e6; color:#8a6d0a; cursor:pointer;">⏸️ Cambiar estado</button>
                  <button onclick="confirmarEliminacion(<?= $vac['idVacante'] ?>)" style="padding:8px 10px; border-radius:8px; border:none; background:#ffebee; color:#c62828; cursor:pointer;">🗑️ Eliminar</button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="padding:40px; text-align:center; color:#666;">No tienes vacantes publicadas aún. <a href="?cargar=VacantesAddView" style="color:#1e3c72; font-weight:700; text-decoration:none;">Publicar ahora</a></td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<script>
  function confirmarEliminacion(idVacante) {
    if (confirm("¿Estás seguro de que deseas eliminar esta vacante? Esta acción es irreversible.")) {
      // Redirigir a la acción que elimina en el back-end (router esperado)
      window.location.href = "?cargar=EliminarVacanteAction&id=" + idVacante;
    }
  }

  function confirmarEstado(idVacante, estadoActual) {
    // Ejemplo simple: alterna entre Abierta y Cerrada. Ajusta según tu lógica en backend.
    let siguiente = '';
    estadoActual = estadoActual.toLowerCase();
    if (estadoActual === 'abierta') siguiente = 'Cerrada';
    else if (estadoActual === 'cerrada') siguiente = 'Abierta';
    else siguiente = 'Abierta';

    if (confirm("Cambiar estado de la vacante a: " + siguiente + " ?")) {
      // Redirigir a la acción que actualiza el estado (implementa en backend)
      window.location.href = "?cargar=CambiarEstadoVacanteAction&id=" + idVacante + "&nuevoEstado=" + encodeURIComponent(siguiente);
    }
  }
</script>