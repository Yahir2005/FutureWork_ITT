<?php
// MisVacantesListView
// Esta vista obtiene las vacantes desde la base de datos usando:
// - usecase/Vacantes/VacanteController.php
// - usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php
//
// Requisitos:
// - El id de la empresa se intenta obtener desde la sesión ($_SESSION['EmpresaId']).
// - Si no hay sesión, puedes pasar ?empresa_id=XX para probar.
// - Si no existe información real, la vista cae a datos de ejemplo (para desarrollo).

session_start();

// Cargar controladores
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";

// Obtener id de empresa: preferencia sesión -> GET -> null
$idEmpresa = null;
if (!empty($_SESSION['EmpresaId'])) {
    $idEmpresa = $_SESSION['EmpresaId'];
} elseif (!empty($_GET['empresa_id'])) {
    $idEmpresa = (int) $_GET['empresa_id'];
}

// Inicializar estructuras
$vacantes = [];
$estadoMap = [];

// Si tenemos idEmpresa, pedir al controlador
if ($idEmpresa) {
    $vacanteController = new VacanteController();
    $estadoController = new EstadoValidacionVacanteController();

    // Obtener vacantes de la empresa
    $respVac = $vacanteController->ListarVacantesPorEmpresa($idEmpresa);
    if ($respVac && isset($respVac->status) && strtolower($respVac->status) === 'ok' && !empty($respVac->body)) {
        // $respVac->body viene como array asociativo de filas desde el gateway
        $vacantesRaw = $respVac->body;
        // Obtener todos los estados para mapear id -> nombre
        $respEstados = $estadoController->ListarEstadoValidacionVacante();
        if ($respEstados && isset($respEstados->status) && (strtolower($respEstados->status) === 'ok' || strtoupper($respEstados->status) === 'OK')) {
            $estados = $respEstados->body;
            // Construir mapa por id (tratamos varios nombres posibles de columna)
            foreach ($estados as $e) {
                $idKeys = ['idEstadoValidacionVacante', 'EstadoValidacionVacanteId', 'id', 'EstadoValidacionVacante_idEstadoValidacionVacante'];
                $nameKeys = ['nombre', 'Nombre', 'Descripcion', 'descripcion', 'estado'];
                $idVal = null;
                $nameVal = null;
                foreach ($idKeys as $k) {
                    if (array_key_exists($k, $e)) { $idVal = $e[$k]; break; }
                }
                foreach ($nameKeys as $k) {
                    if (array_key_exists($k, $e)) { $nameVal = $e[$k]; break; }
                }
                if ($idVal !== null) {
                    $estadoMap[$idVal] = $nameVal ?? "Estado #{$idVal}";
                }
            }
        }

        // Normalizar vacantes a la estructura usada en la plantilla
        foreach ($vacantesRaw as $r) {
            // campos en la BD (según VacanteGateway): idVacante, titulo, descripcion, fechaLimite, EstadoValidacionVacante_idEstadoValidacionVacante, TipoModalidad_idTipoModalidad, TipoContrato_idTipoContrato
            $id = $r['idVacante'] ?? ($r['id'] ?? null);
            $titulo = $r['titulo'] ?? '';
            $descripcion = $r['descripcion'] ?? '';
            // usar fechaLimite o fechaPublicacion si existe
            $fechaPublicacion = $r['fechaPublicacion'] ?? $r['fechaLimite'] ?? (isset($r['fecha']) ? $r['fecha'] : null);
            // estado id y nombre
            $estadoId = $r['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? ($r['estado_id'] ?? null);
            $estadoNombre = $estadoMap[$estadoId] ?? ($r['estatus'] ?? ($r['estado'] ?? 'Desconocido'));
            // candidatos: si no hay fuente, dejar 0 (puedes implementar un método para contarlos)
            $candidatos = $r['candidatos'] ?? 0;
            // modalidad y tipoContrato muestran ids si no hay relaciones resueltas.
            $modalidad = $r['TipoModalidad_idTipoModalidad'] ?? ($r['modalidad'] ?? 'N/A');
            $tipoContrato = $r['TipoContrato_idTipoContrato'] ?? ($r['tipoContrato'] ?? 'N/A');

            $vacantes[] = [
                'idVacante' => $id,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'fechaPublicacion' => $fechaPublicacion,
                'estatus' => $estadoNombre,
                'candidatos' => (int)$candidatos,
                'modalidad' => $modalidad,
                'tipoContrato' => $tipoContrato
            ];
        }
    }
}

// Si no obtuvimos vacantes desde BD, usamos datos de ejemplo (útil para diseño)
/*
if (empty($vacantes)) {
    $vacantes = [
        [
            'idVacante' => 101,
            'titulo' => 'Desarrollador PHP / Laravel',
            'descripcion' => 'Se requiere desarrollador con experiencia en Laravel, APIs REST y MySQL.',
            'fechaPublicacion' => '2025-10-01',
            'estatus' => 'Abierta',
            'candidatos' => 14,
            'modalidad' => 'Remoto',
            'tipoContrato' => 'Tiempo Completo'
        ],
        [
            'idVacante' => 102,
            'titulo' => 'Diseñador UI/UX',
            'descripcion' => 'Diseñador con experiencia en Figma y prototipos interactivos.',
            'fechaPublicacion' => '2025-09-20',
            'estatus' => 'Cerrada',
            'candidatos' => 9,
            'modalidad' => 'Híbrido',
            'tipoContrato' => 'Medio Tiempo'
        ],
        [
            'idVacante' => 103,
            'titulo' => 'Analista de Datos',
            'descripcion' => 'Experiencia con Python, pandas y visualización de datos.',
            'fechaPublicacion' => '2025-08-30',
            'estatus' => 'Pausada',
            'candidatos' => 5,
            'modalidad' => 'Presencial',
            'tipoContrato' => 'Por Proyecto'
        ]
    ];
}
*/
$totalVacantes = count($vacantes);
$vacantesAbiertas = count(array_filter($vacantes, fn($v) => strtolower($v['estatus']) === 'abierta'));
$totalCandidatos = array_sum(array_column($vacantes, 'candidatos'));
?>

<!-- Fragmento para incluir dentro de navbarEmpresa.php -->
<main class="main-content" style="padding-top: 30px; padding-bottom: 60px;">
  <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:24px;">
    <div>
      <h1 style="color:#1e3c72; font-size:28px; margin-bottom:6px;">📋 Mis Vacantes</h1>
      <p style="color:#666;">Administra las vacantes que has publicado — revisa candidatos, edita o elimina publicaciones.</p>
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
              <td style="padding:14px 18px; vertical-align:middle;"><?= $vac['fechaPublicacion'] ? date("d/m/Y", strtotime($vac['fechaPublicacion'])) : '-' ?></td>
              <td style="padding:14px 18px; vertical-align:middle;"><?= htmlspecialchars($vac['modalidad']) ?> / <?= htmlspecialchars($vac['tipoContrato']) ?></td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle; font-weight:700; color:#1976d2;"><?= (int)$vac['candidatos'] ?></td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle;">
                <?php
                  $estatus = strtolower($vac['estatus']);
                  $badgeStyle = '';
                  if ($estatus === 'abierta') {
                      $badgeStyle = 'background:#e8f5e9;color:#388e3c;padding:6px 12px;border-radius:18px;font-weight:700;';
                  } elseif ($estatus === 'cerrada') {
                      $badgeStyle = 'background:#ffebee;color:#c62828;padding:6px 12px;border-radius:18px;font-weight:700;';
                  } elseif ($estatus === 'pausada') {
                      $badgeStyle = 'background:#fff7e6;color:#f57c00;padding:6px 12px;border-radius:18px;font-weight:700;';
                  } else {
                      $badgeStyle = 'background:#f0f0f0;color:#666;padding:6px 12px;border-radius:18px;font-weight:700;';
                  }
                ?>
                <span style="<?= $badgeStyle ?>"><?= htmlspecialchars($vac['estatus']) ?></span>
              </td>
              <td style="padding:14px 18px; text-align:center; vertical-align:middle;">
                <div style="display:flex; gap:8px; justify-content:center; flex-wrap:wrap;">
                  <button onclick="location.href='?cargar=CandidatosListView&id=<?= $vac['idVacante'] ?>'" style="padding:8px 10px; border-radius:8px; border:none; background:#e3f2fd; color:#1976d2; cursor:pointer;">👥 Candidatos</button>
                  <button onclick="location.href='?cargar=VacantesEditView&id=<?= $vac['idVacante'] ?>'" style="padding:8px 10px; border-radius:8px; border:none; background:#fff3e0; color:#f57c00; cursor:pointer;">✏️ Editar</button>
                  <button onclick="confirmarEstado(<?= $vac['idVacante'] ?>,'<?= addslashes($vac['estatus']) ?>')" style="padding:8px 10px; border-radius:8px; border:none; background:#fff7e6; color:#8a6d0a; cursor:pointer;">⏸️ Cambiar estado</button>
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
      window.location.href = "?cargar=EliminarVacanteAction&id=" + idVacante;
    }
  }

  function confirmarEstado(idVacante, estadoActual) {
    let siguiente = '';
    estadoActual = estadoActual.toLowerCase();
    if (estadoActual === 'abierta') siguiente = 'Cerrada';
    else if (estadoActual === 'cerrada') siguiente = 'Abierta';
    else siguiente = 'Abierta';

    if (confirm("Cambiar estado de la vacante a: " + siguiente + " ?")) {
      window.location.href = "?cargar=CambiarEstadoVacanteAction&id=" + idVacante + "&nuevoEstado=" + encodeURIComponent(siguiente);
    }
  }
</script>