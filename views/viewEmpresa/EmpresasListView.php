<?php
  require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
  require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';

  $listarValidaciones = array();
  $estadoValidacionEmpresaController = new EstadoValidacionEmpresaController();
  $resultValidaciones = $estadoValidacionEmpresaController->ListarValidacionesEmpresa();
  if($resultValidaciones->status == "ok"){
    $listarValidaciones = $resultValidaciones->body;
  }

  $controller = new EmpresaController();
  $listar = array();
  $resultEmpresas = $controller->listarEmpresas(); 
  if($resultEmpresas->status == "ok"){
    $listar = $resultEmpresas->body;
  }

  
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Listado de Empresas</title>
  <link rel="stylesheet" href="css/EmpresasListView.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
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
    <!-- Filter Section -->
    <div class="filter-section">
      <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
      <form method="GET" action="" class="filter-form">
        <div class="filter-group">
          <label for="nombre">Nombre de Empresa</label>
          <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre...">
        </div>
        <div class="filter-group">
          <label for="sector">Sector</label>
          <input type="text" id="sector" name="sector" placeholder="Ej: Tecnología, Salud...">
        </div>
        <div class="filter-group">
          <label for="validacion">Estado de Validación</label>
          <select id="validacion" name="validacion">
            <option value="">Todos los estados</option>
            <option value="1">Validada</option>
            <option value="2">Pendiente</option>
            <option value="3">Rechazada</option>
          </select>
        </div>
        <div class="filter-actions">
          <button type="submit" class="btn-filter">🔍 Buscar</button>
          <a href="?" class="btn-clear">✖ Limpiar</a>
        </div>
      </form>
    </div>

    <!-- Results Header -->
    <div class="results-header">
      <div class="results-count">
        Total de empresas: <span><?php echo count($listar); ?></span>
      </div>
      <form method="GET" action="" class="sort-form">
        <label for="ordenar">Ordenar por:</label>
        <select id="ordenar" name="ordenar" onchange="this.form.submit()">
          <option value="nombre_asc">Nombre A-Z</option>
          <option value="nombre_desc">Nombre Z-A</option>
          <option value="fecha_desc">Más recientes</option>
          <option value="fecha_asc">Más antiguas</option>
          <option value="vacantes_desc">Más vacantes</option>
          <option value="vacantes_asc">Menos vacantes</option>
        </select>
      </form>
    </div>

    <!-- Companies Grid -->
    <div class="companies-grid">
      <?php if (count($listar) > 0): ?>
        <?php foreach ($listar as $empresa): ?>
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
                <span class="stat-value">0</span>
              </div>
              <div class="stat-item">
                <span class="stat-label">Abiertas</span>
                <span class="stat-value">0</span>
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
