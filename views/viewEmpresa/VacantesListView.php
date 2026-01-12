<?php
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

$vacanteController = new VacanteController();

/**Contar total de vacantes */
$totalVacantes = $vacanteController->contarVacantes();
$totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
$totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
$totalVacantesPausadas = $vacanteController->contarVacantesPausadas();




// --- Empresas ---
$listarVacantesCard = array();
$resultEmpresas = $vacanteController->ListarVacantesTotalesCard() ;
if(strtolower($resultEmpresas->status) == "ok"){
  $listarVacantesCard = $resultEmpresas->body;
}




/**Controladores */
/*
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
*/
/**Arrays*/
/*
$listarVacantes = array(); // Aquí se almacenarán las vacantes obtenidas
$listarEmpresa = array(); // Aquí se almacenará la información de la empresa
$listarValidacionVacante = array();
$listarTipoContrato = array();
$listarTipoModalidad = array();*/

/**Contadores */
/*
$totalVacantes = 0;
$totalAbiertas = 0;
$totalCerradas = 0;
$totalPausadas = 0;*/

/**Instancias */
/*
$vacanteController = new VacanteController();
$empresaController = new EmpresaController();
$vacanteValidacionController = new EstadoValidacionVacanteController();
$TipoContratoController = new TipoContratoController();
$TipoModalidadController = new TipoModalidadController();*/

/**Listar */
/*
if($resultListarValidacionVacante->status == "OK"){
  $listarValidacionVacante = $resultListarValidacionVacante->body;
}
if($resultListarTipoContrato->status == "Ok"){
  $listarTipoContrato = $resultListarTipoContrato->body;
}

if($resultListarTipoModalidad->status == "ok"){
  $listarTipoModalidad = $resultListarTipoModalidad->body;
}
if ($resultVacantes && $resultVacantes->status == "ok" && is_array($resultVacantes->body)) {
  $listarVacantes = $resultVacantes->body;
  $totalVacantes = count($listarVacantes);

  foreach ($listarVacantes as $vacante) {
      // Estado de la vacante: campo EstadoValidacionVacante_idEstadoValidacionVacante
      switch ($vacante['EstadoValidacionVacante_idEstadoValidacionVacante']) {
          case 1: // Abierta
              $totalAbiertas++;
              break;
          case 2: // Cerrada
              $totalCerradas++;
              break;
          case 3: // Pausada
              $totalPausadas++;
              break;
      }
  }
}

$vacanteController = new VacanteController();
$empresaController = new EmpresaController();
*/
// 1. Obtener ID de la empresa de la URL
/*
$idEmpresa = $_GET['idEmpresa'] ?? null;
$nombreEmpresa = "Empresa no encontrada";
*/
/*if ($idEmpresa) {
    $resEmpresa = $empresaController->obtenerEmpresaPorId($idEmpresa);
   if(strtolower($resEmpresa->status()) == "ok") {
        // Ajusta 'nombreEmpresa' según el nombre real en tu base de datos
        $nombreEmpresa = $resEmpresa->body['nombreEmpresa'] ?? "Nombre de Empresa";
    }
}*/
// 2. Carga inicial de vacantes
/*
$listar = [];
$resultVacantes = $vacanteController->listarVacantesPorEmpresa($idEmpresa);
if(strtolower($resultVacantes->status) == "ok"){
    $listar = $resultVacantes->body;
}

// 3. Lógica de Filtros (Estilo de tu compañero)
if (isset($_GET["titulo"]) || isset($_GET["estado"]) || isset($_GET["modalidad"])) {
    $titulo = trim($_GET["titulo"] ?? "");
    $estado = trim($_GET["estado"] ?? "");
    $modalidad = trim($_GET["modalidad"] ?? "");

    $filtrado = $listar;

    if (!empty($titulo)) {
        $filtrado = array_filter($filtrado, function ($v) use ($titulo) {
            return stripos($v["tituloVacante"], $titulo) !== false;
        });
    }
    if (!empty($estado)) {
        $filtrado = array_filter($filtrado, function ($v) use ($estado) {
            return $v["idEstadoVacante"] == $estado;
        });
    }
    if (!empty($modalidad)) {
        $filtrado = array_filter($filtrado, function ($v) use ($modalidad) {
            return $v["idModalidad"] == $modalidad;
        });
    }
    $listar = array_values($filtrado);
}
*/
// 4. Estadísticas
/*
$totalVacantes = count($listar);
$abiertas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 1));
$cerradas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 2));
$pausadas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 3));
*/
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
            <?php echo $totalVacantes->body ?>
          </div><!-- Aquí PHP mostrará el total -->
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ✅ Vacantes Abiertas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesAbiertas->body ?>
          </div><!-- Aquí PHP mostrará las abiertas -->
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ❌ Vacantes Cerradas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesCerradas->body ?>
          </div><!-- Aquí PHP mostrará las cerradas -->
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ⏸️ Vacantes Pausadas
          </div>
          <div class="stat-value">
            <?php echo $totalVacantesPausadas->body ?>

          </div><!-- Aquí PHP mostrará las pausadas -->
        </div>
      </div>
    </div>
  </header><!-- Main Container -->
  <main class="container">

    <!-- Aquí irán los mensajes de éxito o error desde PHP -->

    <!-- 
    <div class="alert alert-success">
      ✓ Vacante eliminada exitosamente
    </div>
    <div class="alert alert-error">
      ✗ Error al procesar la solicitud
    </div>
    <div class="alert alert-info">
      ℹ No se encontraron vacantes con los filtros aplicados
    </div>
-->

    <!-- Filter Section -->
    <!--

   <div class="filter-section">
    <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
    <form method="GET" action="" class="filter-form">
    <input type="hidden" name="idEmpresa" value=""> 
    /**Aquí PHP incluirá el ID de la empresa */
     <div class="filter-group">
     <label for="titulo">Título</label> 
     <input type="text" id="titulo" name="titulo" placeholder="Buscar por título...">
     </div>
     <div class="filter-group"><label for="estado">Estado</label> 
     <select id="estado" name="estado"> 
     <option value="">Todos los estados</option> 
     <option value="1">Abierta</option> 
     <option value="2">Cerrada</option> 
     <option value="3">Pausada</option> 
     </select>
     </div>
     <div class="filter-group"><label for="tipo_contrato">Tipo Contrato</label> 
     <select id="tipo_contrato" name="tipo_contrato"> 
     <option value="">Todos los tipos</option> 
     <option value="1">Tiempo Completo</option> 
     <option value="2">Medio Tiempo</option> 
     <option value="3">Por Proyecto</option> 
     <option value="4">Pasantía</option> 
     </select>
     </div>
     <div class="filter-group">
     <label for="modalidad">Modalidad</label> 
     <select id="modalidad" name="modalidad"> 
     <option value="">Todas las modalidades</option> 
     <option value="1">Presencial</option> 
     <option value="2">Remoto</option> 
     <option value="3">Híbrido</option> </select>
     </div>
     <div class="filter-actions">
     <button type="submit" class="btn-filter">🔍 Buscar</button> 
     <a href="?idEmpresa=" class="btn-clear">✖ Limpiar</a>
     </div>
    </form>

   </div>/** Results Header */
   <div class="results-header">
    <div class="results-count">
     Mostrando: <span>0</span> vacantes 
     
     /** Aquí PHP mostrará el conteo filtrado */
    </div>
    <form method="GET" action="" class="sort-form"><input type="hidden" name="idEmpresa" value=""> 
    <label for="ordenar">Ordenar por:</label> 
    <select id="ordenar" name="ordenar" onchange="this.form.submit()"> 
    <option value="fecha_desc">Más recientes</option> 
    <option value="fecha_asc">Más antiguas</option> 
    <option value="titulo_asc">Título A-Z</option> 
    <option value="titulo_desc">Título Z-A</option> 
    <option value="salario_desc">Salario mayor</option> 
    <option value="salario_asc">Salario menor</option> </select>
    </form>
   </div>
-->




<?php if (count($listarVacantesCard) > 0): ?>
        <?php 
          $currentDate = date('Y-m-d');
        ?>
        <?php foreach ($listarVacantesCard as $vacantes): ?>

    <!-- Vacancies Grid -->
    <div class="vacancies-grid">

      <!-- Aquí PHP generará las tarjetas de vacantes dinámicamente -->
      <!-- Ejemplo de estructura de una tarjeta (comentado para referencia):--->

      <div class="vacancy-card">
        <div class="vacancy-header">
          <div class="vacancy-title">
            <h3>Título de la Vacante</h3>
            <div class="vacancy-id">ID: 123</div>
          </div>
          <span class="vacancy-status status-abierta">Abierta</span>
        </div>

        <div class="vacancy-details">
          <div class="detail-item">📍 Ubicación</div>
          <div class="detail-item">💰 $15,000.00</div>
          <div class="detail-item">📅 Límite: 31/12/2024</div>
        </div>

        <p class="vacancy-description">
          Descripción de la vacante...
        </p>

        <div class="vacancy-tags">
          <span class="tag contract">Tiempo Completo</span>
          <span class="tag modality">Remoto</span>
          <span class="tag salary">$15,000</span>
        </div>

        <div class="vacancy-footer">
          <div class="posted-date">
            📅 Publicado: 15/01/2024
          </div>
          <div class="vacancy-actions">
            <a href="detalle-vacante.php?id=1" class="btn-details">Ver Detalles</a>
            <a href="editar-vacante.php?id=1" class="btn-edit">✏️ Editar</a>
            <form method="POST" action="eliminar-vacante.php" style="display:inline;">
              <input type="hidden" name="id" value="1">
              <button type="submit" class="btn-delete"
                onclick="return confirm('¿Estás seguro de eliminar esta vacante?')">🗑️ Eliminar</button>
            </form>
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
        </div>
      <?php endif; ?>






      <!-- Empty State (mostrar cuando no hay vacantes) -->
      <!--

  /**se muestra cuando no hay vacantes  */
  <div class="empty-state">
     <div class="empty-state-icon">
      📭
     </div>
     <h3>No se han encontrado vacantes publicadas</h3>
     <p>No hay vacantes disponibles.</p>
    </div>
   </div>
-->


  </main>
  <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'9a1535ac6670b1f2',t:'MTc2MzYxMzAwMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
</body>

</html>