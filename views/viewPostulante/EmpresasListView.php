<?php

// Aseguramos la sesión si es una vista de administración
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Intenta subir TRES niveles (por si la inclusión es más profunda)
require_once __DIR__ . '/../../usecase/Empresas/EmpresasController.php'; 
require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';

/* Inicialización de variables */
$listarEmpresas = array();
$listarValidacion = array(); // Para el dropdown de Validación
$MessageID = "";
$filtros = array(
    'nombre' => $_GET['nombre'] ?? null,
    'sector' => $_GET['sector'] ?? null,
    'validacion' => $_GET['validacion'] ?? null,
    'ordenar' => $_GET['ordenar'] ?? 'nombre_asc'
);

/* Instanciar Controladores */
$empresaController = new EmpresaController();
$validacionController = new EstadoValidacionEmpresaController();


// --- Lógica de LISTADO DE EMPRESAS con Filtros y Ordenamiento ---
// Usaremos un nuevo método que acepta los filtros. Asume que listarEmpresas ahora maneja los argumentos.
$resultListarEmpresas = $empresaController->listarEmpresas($filtros);

if($resultListarEmpresas && ($resultListarEmpresas->status == "ok" || $resultListarEmpresas->status == "OK")){
    $listarEmpresas = $resultListarEmpresas->body;
} else {
    $MessageID = "<div class='alert alert-error' role='alert'>✗ Error al cargar empresas: ".$resultListarEmpresas->message."</div>";
}

// --- Lógica para cargar el Dropdown de Validación (Opcional, si tienes una tabla de lookup) ---
$resultValidacion = $validacionController->ListarValidacionesEmpresa(); 
if($resultValidacion && ($resultValidacion->status == "ok" || $resultValidacion->status == "OK")){
    // Asume que la tabla de validación tiene 'idEstadoValidacionEmpresa' y 'estado'
    $listarValidacion = $resultValidacion->body; 
}
/** Función de Ayuda para generar el nombre de la clase de estado */
function getStatusClass($id) {
    switch ($id) {
        case 1: return 'status-validada';
        case 2: return 'status-pendiente';
        case 3: return 'status-rechazada';
        default: return 'status-desconocido';
    }
}
function getStatusName($id) {
    switch ($id) {
        case 1: return '✓ Validada';
        case 2: return '⌛ Pendiente';
        case 3: return '✗ Rechazada';
        default: return 'Estado Desconocido';
    }
}

?>
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
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><header class="header">
   <div class="header-content">
    <div class="header-text">
     <h1>🏢 Gestión de Empresas</h1>
     <p>Administra las empresas registradas en la plataforma</p>
    </div>
    <div class="header-actions"><a href="agregar-empresa.php" class="btn-add">➕ Registrar Nueva Empresa</a>
    </div>
   </div>
  </header><main class="container">
    <?php echo $MessageID; ?>

    <div class="filter-section">
    <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
    <form method="GET" action="" class="filter-form">
      <div class="filter-group"><label for="nombre">Nombre de Empresa</label> <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre..." value="<?php echo htmlspecialchars($filtros['nombre'] ?? ''); ?>">
     </div>
      <div class="filter-group"><label for="sector">Sector</label> <input type="text" id="sector" name="sector" placeholder="Ej: Tecnología, Salud..." value="<?php echo htmlspecialchars($filtros['sector'] ?? ''); ?>">
     </div>
      <div class="filter-group"><label for="validacion">Estado de Validación</label> 
       <select id="validacion" name="validacion"> 
           <option value="">Todos los estados</option> 
           <?php foreach ($listarValidacion as $estado): ?>
               <option 
                   value="<?php echo $estado['idEstadoValidacionEmpresa']; ?>"
                   <?php echo (isset($filtros['validacion']) && $filtros['validacion'] == $estado['idEstadoValidacionEmpresa']) ? 'selected' : ''; ?>
               >
                   <?php echo $estado['estado']; ?>
               </option>
           <?php endforeach; ?>
       </select>
     </div>
     <div class="filter-actions"><button type="submit" class="btn-filter">🔍 Buscar</button> <a href="?" class="btn-clear">✖ Limpiar</a>
     </div>
    </form>
   </div><div class="results-header">
    <div class="results-count">
     Total de empresas: <span><?php echo count($listarEmpresas); ?></span> </div>
    <form method="GET" action="" class="sort-form"><label for="ordenar">Ordenar por:</label> <select id="ordenar" name="ordenar" onchange="this.form.submit()"> 
      <option value="nombre_asc" <?php echo ($filtros['ordenar'] == 'nombre_asc') ? 'selected' : ''; ?>>Nombre A-Z</option> 
      <option value="nombre_desc" <?php echo ($filtros['ordenar'] == 'nombre_desc') ? 'selected' : ''; ?>>Nombre Z-A</option> 
      <option value="fecha_desc" <?php echo ($filtros['ordenar'] == 'fecha_desc') ? 'selected' : ''; ?>>Más recientes</option> 
      <option value="fecha_asc" <?php echo ($filtros['ordenar'] == 'fecha_asc') ? 'selected' : ''; ?>>Más antiguas</option> 
      <option value="vacantes_desc" <?php echo ($filtros['ordenar'] == 'vacantes_desc') ? 'selected' : ''; ?>>Más vacantes</option> 
      <option value="vacantes_asc" <?php echo ($filtros['ordenar'] == 'vacantes_asc') ? 'selected' : ''; ?>>Menos vacantes</option> 
    </select>
    </form>
   </div><div class="companies-grid">
    
    <?php if (!empty($listarEmpresas)): ?>
        <?php foreach ($listarEmpresas as $empresa): ?>
            <div class="company-card">
                <div class="company-header">
                    <div class="company-icon">🏢</div>
                    <div class="company-title">
                        <h3><?php echo htmlspecialchars($empresa['nombre']); ?></h3>
                        <div class="company-sector">Sector <?php echo htmlspecialchars($empresa['sector']); ?></div>
                    </div>
                    <span class="validation-status <?php echo getStatusClass($empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']); ?>">
                        <?php echo getStatusName($empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']); ?>
                    </span>
                </div>

                <p class="company-description">
                    <?php echo htmlspecialchars($empresa['descripcionCorta'] ?? 'Sin descripción disponible.'); ?>
                </p>

                <div class="company-stats">
                    <div class="stat-item">
                        <span class="stat-label">Vacantes</span>
                        <span class="stat-value"><?php echo $empresa['totalVacantes'] ?? 0; ?></span> 
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Ubicación</span>
                        <span class="stat-value"><?php echo $empresa['ciudad'] ?? 'N/A'; ?></span> 
                    </div>
                </div>

                <div class="company-footer">
                    <div class="registration-date">
                        📅 Registrada: <?php echo date('d/m/Y', strtotime($empresa['fechaRegistro'])); ?>
                    </div>
                    <div class="company-actions">
                        <a href="perfil-empresa.php?id=<?php echo $empresa['idEmpresa']; ?>" class="btn-profile">👁️ Ver Perfil</a>
                        <a href="vacantes-empresa.php?idEmpresa=<?php echo $empresa['idEmpresa']; ?>" class="btn-vacancies">💼 Ver Vacantes</a>
                        <a href="editar-empresa.php?id=<?php echo $empresa['idEmpresa']; ?>" class="btn-edit">✏️ Editar</a>
                        <form method="POST" action="eliminar-empresa.php" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar la empresa <?php echo htmlspecialchars($empresa['nombre']); ?>?')">
                            <input type="hidden" name="id" value="<?php echo $empresa['idEmpresa']; ?>">
                            <button type="submit" class="btn-delete">🗑️ Eliminar</button>
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
            <a href="agregar-empresa.php" class="btn-add">➕ Registrar Nueva Empresa</a>
        </div>
    <?php endif; ?>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a155cd3b54db1f2',t:'MTc2MzYxNDYwNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>