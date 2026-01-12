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

// --- Vacantes ---
$vacanteController = new VacanteController();

// --- Filtros (PHP Fallback) ---
// Se mantiene el filtrado PHP por si JavaScript falla o para la carga inicial con parámetros
if (isset($_GET["buscar"])) {

    $nombre = trim($_GET["nombre"] ?? "");
    $sector = trim($_GET["sector"] ?? "");
    $validacion = trim($_GET["validacion"] ?? "");

    // Filtrar siempre sobre el array completo $listar para mayor consistencia
    $filtrado = $listar;

    if (!empty($nombre)) {
        $filtrado = array_filter($filtrado, function ($empresa) use ($nombre) {
            return stripos($empresa["nombreEmpresa"], $nombre) !== false;
        });
    }

    if (!empty($sector)) {
        $filtrado = array_filter($filtrado, function ($empresa) use ($sector) {
            return stripos($empresa["sector"], $sector) !== false;
        });
    }

    if (!empty($validacion)) {
        $filtrado = array_filter($filtrado, function ($empresa) use ($validacion) {
            return $empresa["EstadoValidacionEmpresa_idEstadoValidacionEmpresa"] == $validacion;
        });
    }

    $listar = array_values($filtrado);
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Listado de Empresas</title>
  <link rel="stylesheet" href="css/EmpresasListView.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <div class="header-text">
        <h1>🏢 Gestión de Empresas</h1>
        <p>Administra las empresas registradas en la plataforma</p>
      </div>
      <div class="header-actions">
        <a href="agregar-empresa.php" class="btn-add">➕ Registrar Nueva Empresa</a>
      </div>
    </div>
  </header>

  <!-- Main Container -->
  <main class="container">
    <!-- Filter Section con fondo blanco -->
    <div class="filter-section bg-white p-4 rounded shadow">
      <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
      <!-- Se mantiene el form para soporte sin JS y deep linking -->
      <form method="GET" action="" class="filter-form" id="filterForm">
        <div class="filter-group">
          <label for="nombre">Nombre de Empresa</label>
          <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre..." 
                 value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
        </div>
        <div class="filter-group">
          <label for="sector">Sector</label>
          <input type="text" id="sector" name="sector" placeholder="Ej: Tecnología, Salud..." 
                 value="<?php echo isset($_GET['sector']) ? htmlspecialchars($_GET['sector']) : ''; ?>">
        </div>
        <div class="filter-group">
          <label for="validacion">Estado de Validación</label>
          <select id="validacion" name="validacion">
            <option value="">Todos los estados</option>
            <?php foreach($listarValidaciones as $id => $nombre): ?>
              <option value="<?php echo $id; ?>" 
                <?php echo (isset($_GET['validacion']) && $_GET['validacion'] == $id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($nombre); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="filter-actions">
          <button type="submit" class="btn-filter" name="buscar" value="buscar">🔍 Buscar</button>
          <a href="?" class="btn-clear" id="btnClear">✖ Limpiar</a>
        </div>
      </form>
    </div>

    <!-- Companies Grid -->
    <div class="companies-grid" id="companiesGrid">
      <?php if (count($listar) > 0): ?>
        <?php 
          $currentDate = date('Y-m-d');
        ?>
        <?php foreach ($listar as $empresa): ?>
          <?php
            $resultVacantes = $vacanteController->ListarVacantesPorEmpresa($empresa['idEmpresas']);
            $countVacantes = 0;
            $countAbiertas = 0;
            
            if (isset($resultVacantes->status) && strtolower($resultVacantes->status) == "ok" && is_array($resultVacantes->body)) {
              $countVacantes = count($resultVacantes->body);
              foreach ($resultVacantes->body as $vacante) {
                if (isset($vacante['fechaLimite']) && $vacante['fechaLimite'] >= $currentDate) {
                  $countAbiertas++;
                }
              }
            }
          ?>
          <!-- Agregamos data-attributes para facilitar el filtrado con JS -->
          <div class="company-card" 
               data-nombre="<?php echo htmlspecialchars(strtolower($empresa['nombreEmpresa'])); ?>"
               data-sector="<?php echo htmlspecialchars(strtolower($empresa['sector'])); ?>"
               data-validacion="<?php echo $empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']; ?>">
            
            <div class="company-header">
              <div class="company-icon">🏢</div>
              <div class="company-title">
                <h3><?php echo htmlspecialchars($empresa['nombreEmpresa']); ?></h3>
                <div class="company-sector">Sector: <?php echo htmlspecialchars($empresa['sector']); ?></div>
              </div>
              <?php
                $estado = intval($empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']);
                $estados = ["", "✓ Validada", "⏳ Pendiente", "✗ Rechazada"];
                $clasesEstado = ["", "status-validada", "status-pendiente", "status-rechazada"];
                $textoEstado = isset($estados[$estado]) ? $estados[$estado] : "Desconocido";
                $claseEstado = isset($clasesEstado[$estado]) ? $clasesEstado[$estado] : "";
              ?>
              <span class="validation-status <?php echo $claseEstado; ?>">
                <?php echo $textoEstado; ?>
              </span>
            </div>

            <p class="company-description">
              <?php echo htmlspecialchars($empresa['descripcion']); ?>
            </p>

            <div class="company-stats">
              <div class="stat-item">
                <span class="stat-label">Vacantes</span>
                <span class="stat-value"><?php echo $countVacantes; ?></span>
              </div>
              <div class="stat-item">
                <span class="stat-label">Abiertas</span>
                <span class="stat-value"><?php echo $countAbiertas; ?></span>
              </div>
            </div>

            <div class="company-footer">
              <div class="registration-date">📅</div>
              <div class="company-actions">
                <a href="perfil-empresa.php?id=<?php echo $empresa['idEmpresas']; ?>" class="btn-profile">👁️ Ver Perfil</a>
                <a href="vacantes-empresa.php?idEmpresa=<?php echo $empresa['idEmpresas']; ?>" class="btn-vacancies">💼 Ver Vacantes</a>
                <a href="editar-empresa.php?id=<?php echo $empresa['idEmpresas']; ?>" class="btn-edit">✏️ Editar</a>
                <form method="POST" action="eliminar-empresa.php" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $empresa['idEmpresas']; ?>">
                  <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">🗑️ Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-icon">🏢</div>
          <h3>No se encontraron empresas</h3>
          <p>No hay empresas registradas en el sistema o no coinciden con los filtros aplicados.</p>
          <a href="agregar-empresa.php" class="btn-add">➕ Registrar Primera Empresa</a>
        </div>
      <?php endif; ?>
      
      <!-- Mensaje de "No hay resultados" para el filtro JS -->
      <div id="no-results-js" class="empty-state hidden" style="display: none;">
          <div class="empty-state-icon">🔍</div>
          <h3>No hay coincidencias</h3>
          <p>Intenta con otros términos de búsqueda.</p>
      </div>
    </div>
  </main>

  <!-- Script para filtrado en tiempo real -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputNombre = document.getElementById('nombre');
        const inputSector = document.getElementById('sector');
        const selectValidacion = document.getElementById('validacion');
        const grid = document.getElementById('companiesGrid');
        const cards = grid.getElementsByClassName('company-card');
        const noResultsMsg = document.getElementById('no-results-js');
        const originalEmptyState = document.querySelector('.companies-grid > .empty-state:not(#no-results-js)');

        function filterCompanies() {
            const nombre = inputNombre.value.toLowerCase().trim();
            const sector = inputSector.value.toLowerCase().trim();
            const validacion = selectValidacion.value;
            
            let visibleCount = 0;
            let hasCards = cards.length > 0;

            Array.from(cards).forEach(card => {
                const cardNombre = card.getAttribute('data-nombre') || '';
                const cardSector = card.getAttribute('data-sector') || '';
                const cardValidacion = card.getAttribute('data-validacion') || '';

                const matchNombre = cardNombre.includes(nombre);
                const matchSector = cardSector.includes(sector);
                const matchValidacion = validacion === '' || cardValidacion === validacion;

                if (matchNombre && matchSector && matchValidacion) {
                    card.style.display = ''; // Restaurar display original (block/flex)
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Manejo de estado vacío
            if (hasCards) {
                if (visibleCount === 0) {
                    if (noResultsMsg) noResultsMsg.style.display = 'flex';
                    if (originalEmptyState) originalEmptyState.style.display = 'none';
                } else {
                    if (noResultsMsg) noResultsMsg.style.display = 'none';
                }
            }
        }

        // Event Listeners para filtrado en tiempo real
        inputNombre.addEventListener('input', filterCompanies);
        inputSector.addEventListener('input', filterCompanies);
        selectValidacion.addEventListener('change', filterCompanies);
    });
  </script>
</body>
</html>