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

// --- Filtros ---
// --- Filtros ---
if (isset($_GET["buscar"])) {

    $nombre = trim($_GET["nombre"] ?? "");
    $sector = trim($_GET["sector"] ?? "");
    $validacion = trim($_GET["validacion"] ?? "");

    $soloNombre = !empty($nombre) && empty($sector) && empty($validacion);
    $soloSector = empty($nombre) && !empty($sector) && empty($validacion);
    $soloValidacion = empty($nombre) && empty($sector) && !empty($validacion);

    // Buscar solo por nombre ( en BD )
    if ($soloNombre) {
        $result = $controller->buscarEmpresasPorNombre($nombre);
        $listar = (strtolower($result->status) == "ok") ? $result->body : [];
    }

    // Buscar solo por sector ( en BD )
    elseif ($soloSector) {
        $result = $controller->buscarEmpresasPorSector($sector);
        $listar = (strtolower($result->status) == "ok") ? $result->body : [];
    }

    // Buscar solo por validación ( en BD )
    elseif ($soloValidacion) {
        $result = $controller->buscarEmpresasPorTipoEstado($validacion);
        $listar = (strtolower($result->status) == "ok") ? $result->body : [];
    }

    // Combinación de filtros → filtrar en PHP
    else {
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
      <form method="GET" action="" class="filter-form">
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
          <a href="?" class="btn-clear">✖ Limpiar</a>
        </div>
      </form>
    </div>


    <!-- Companies Grid -->
    <div class="companies-grid">
      <?php if (count($listar) > 0): ?>
        <?php 
          // Calculate current date once, outside the loop
          $currentDate = date('Y-m-d');
        ?>
        <?php foreach ($listar as $empresa): ?>
          <?php
            // Fetch vacancies for this company
            $resultVacantes = $vacanteController->ListarVacantesPorEmpresa($empresa['idEmpresas']);
            $countVacantes = 0;
            $countAbiertas = 0;
            
            // Check if the result is valid
            if (isset($resultVacantes->status) && strtolower($resultVacantes->status) == "ok" && is_array($resultVacantes->body)) {
              $countVacantes = count($resultVacantes->body);
              
              // Count open vacancies (fechaLimite >= current date)
              foreach ($resultVacantes->body as $vacante) {
                if (isset($vacante['fechaLimite']) && $vacante['fechaLimite'] >= $currentDate) {
                  $countAbiertas++;
                }
              }
            }
          ?>
          <div class="company-card">
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
              ?>
              <span class="validation-status <?php echo $clasesEstado[$estado]; ?>">
                <?php echo $estados[$estado]; ?>
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
    </div>
  </main>
</body>
</html>
