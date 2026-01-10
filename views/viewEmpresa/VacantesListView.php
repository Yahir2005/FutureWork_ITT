<?php
<<<<<<< HEAD
require_once __DIR__ . '/../../usecase/Vacante/VacanteController.php';
require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php'; 
=======
  /**Controladores */
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
  /**Arrays*/
  $listarVacantes = array(); // Aquí se almacenarán las vacantes obtenidas
  $listarEmpresa = array(); // Aquí se almacenará la información de la empresa
  $listarValidacionVacante = array();
  $listarTipoContrato = array();
  $listarTipoModalidad = array();

  /**Contadores */
  $totalVacantes = 0;
  $totalAbiertas = 0;
  $totalCerradas = 0;
  $totalPausadas = 0;

  /**Instancias */
  $vacanteController = new VacanteController();
  $empresaController = new EmpresaController();
  $vacanteValidacionController = new EstadoValidacionVacanteController();
  $TipoContratoController = new TipoContratoController();
  $TipoModalidadController = new TipoModalidadController();
  /**Listar */
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
>>>>>>> 0d1f0c7be41ad916d8702e0cd54bcadc3476f6fc

$vacanteController = new VacanteController();
$empresaController = new EmpresaController();

// 1. Obtener ID de la empresa de la URL
$idEmpresa = $_GET['idEmpresa'] ?? null;
$nombreEmpresa = "Empresa no encontrada";

/*if ($idEmpresa) {
    $resEmpresa = $empresaController->obtenerEmpresaPorId($idEmpresa);
   if(strtolower($resEmpresa->status()) == "ok") {
        // Ajusta 'nombreEmpresa' según el nombre real en tu base de datos
        $nombreEmpresa = $resEmpresa->body['nombreEmpresa'] ?? "Nombre de Empresa";
    }
}*/
// 2. Carga inicial de vacantes
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

// 4. Estadísticas
$totalVacantes = count($listar);
$abiertas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 1));
$cerradas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 2));
$pausadas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 3));
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureWork ITT - Vacantes de <?php echo $nombreEmpresa; ?></title>
    <link rel="stylesheet" href="css/VacantesListView.css">
<<<<<<< HEAD
    <style>@view-transition { navigation: auto; }</style>
    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="header-top">
                <div class="company-info">
                    <h1>🏢 <?php echo htmlspecialchars($nombreEmpresa); ?></h1>
                    <p>Gestión de vacantes publicadas por la empresa</p>
                </div>
                <div class="header-actions">
                    <a href="agregar-vacante.php?idEmpresa=<?php echo $idEmpresa; ?>" class="btn-add">➕ Agregar Vacante</a> 
                    <a href="empresas.php" class="btn-back">← Volver a Empresas</a>
                </div>
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-label">📊 Total</div>
                    <div class="stat-value"><?php echo $totalVacantes; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">✅ Abiertas</div>
                    <div class="stat-value"><?php echo $abiertas; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">❌ Cerradas</div>
                    <div class="stat-value"><?php echo $cerradas; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">⏸️ Pausadas</div>
                    <div class="stat-value"><?php echo $pausadas; ?></div>
                </div>
            </div>
=======
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>

 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-top">
     <div class="company-info">
      <h1>🏢 <!-- Aquí PHP mostrará el nombre de la empresa --></h1>
      <p>Gestión de vacantes publicadas por la empresa</p>
     </div>
     <div class="header-actions"><a href="agregar-vacante.php?idEmpresa=" class="btn-add">➕ Agregar Vacante</a> <a href="empresas.php" class="btn-back">← Volver a Empresas</a>
     </div>
    </div><!-- Stats Cards -->
    <div class="stats-container">
     <div class="stat-card">
      <div class="stat-label">
       📊 Total de Vacantes
      </div>
      <div class="stat-value">
       0
      </div><!-- Aquí PHP mostrará el total -->
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ✅ Vacantes Abiertas
      </div>
      <div class="stat-value">
       0
      </div><!-- Aquí PHP mostrará las abiertas -->
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ❌ Vacantes Cerradas
      </div>
      <div class="stat-value">
       0
      </div><!-- Aquí PHP mostrará las cerradas -->
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ⏸️ Vacantes Pausadas
      </div>
      <div class="stat-value">
       0
      </div><!-- Aquí PHP mostrará las pausadas -->
     </div>
    </div>
   </div>
   
  </header><!-- Main Container -->
  <main class="container"><!-- Aquí irán los mensajes de éxito o error desde PHP --> <!-- 
    <div class="alert alert-success">
      ✓ Vacante eliminada exitosamente
    </div>
    <div class="alert alert-error">
      ✗ Error al procesar la solicitud
    </div>
    <div class="alert alert-info">
      ℹ No se encontraron vacantes con los filtros aplicados
    </div>
    --> <!-- Filter Section -->
   <div class="filter-section">
    <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
    <form method="GET" action="" class="filter-form"><input type="hidden" name="idEmpresa" value=""> <!-- Aquí PHP incluirá el ID de la empresa -->
     <div class="filter-group"><label for="titulo">Título</label> <input type="text" id="titulo" name="titulo" placeholder="Buscar por título...">
     </div>
     <div class="filter-group"><label for="estado">Estado</label> <select id="estado" name="estado"> <option value="">Todos los estados</option> <option value="1">Abierta</option> <option value="2">Cerrada</option> <option value="3">Pausada</option> </select>
     </div>
     <div class="filter-group"><label for="tipo_contrato">Tipo Contrato</label> <select id="tipo_contrato" name="tipo_contrato"> <option value="">Todos los tipos</option> <option value="1">Tiempo Completo</option> <option value="2">Medio Tiempo</option> <option value="3">Por Proyecto</option> <option value="4">Pasantía</option> </select>
     </div>
     <div class="filter-group"><label for="modalidad">Modalidad</label> <select id="modalidad" name="modalidad"> <option value="">Todas las modalidades</option> <option value="1">Presencial</option> <option value="2">Remoto</option> <option value="3">Híbrido</option> </select>
     </div>
     <div class="filter-actions"><button type="submit" class="btn-filter">🔍 Buscar</button> <a href="?idEmpresa=" class="btn-clear">✖ Limpiar</a>
     </div>
    </form>
   </div><!-- Results Header -->
   <div class="results-header">
    <div class="results-count">
     Mostrando: <span>0</span> vacantes <!-- Aquí PHP mostrará el conteo filtrado -->
    </div>
    <form method="GET" action="" class="sort-form"><input type="hidden" name="idEmpresa" value=""> <label for="ordenar">Ordenar por:</label> <select id="ordenar" name="ordenar" onchange="this.form.submit()"> <option value="fecha_desc">Más recientes</option> <option value="fecha_asc">Más antiguas</option> <option value="titulo_asc">Título A-Z</option> <option value="titulo_desc">Título Z-A</option> <option value="salario_desc">Salario mayor</option> <option value="salario_asc">Salario menor</option> </select>
    </form>
   </div><!-- Vacancies Grid -->
   <div class="vacancies-grid"><!-- Aquí PHP generará las tarjetas de vacantes dinámicamente --> <!-- Ejemplo de estructura de una tarjeta (comentado para referencia):
      
      <div class="vacancy-card">
        <div class="vacancy-header">
          <div class="vacancy-title">
            <h3>Título de la Vacante</h3>
            <div class="vacancy-id">ID: 123</div>
          </div>
          <span class="vacancy-status status-abierta">Abierta</span>
>>>>>>> 0d1f0c7be41ad916d8702e0cd54bcadc3476f6fc
        </div>
    </header>

    <main class="container">
        <div class="filter-section">
            <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
            <form method="GET" action="" class="filter-form">
                <input type="hidden" name="idEmpresa" value="<?php echo $idEmpresa; ?>">
                
                <div class="filter-group">
                    <label for="titulo">Título</label> 
                    <input type="text" id="titulo" name="titulo" value="<?php echo $_GET['titulo'] ?? ''; ?>" placeholder="Buscar por título...">
                </div>

                <div class="filter-group">
                    <label for="estado">Estado</label> 
                    <select id="estado" name="estado">
                        <option value="">Todos los estados</option>
                        <option value="1" <?php echo (isset($_GET['estado']) && $_GET['estado'] == '1') ? 'selected' : ''; ?>>Abierta</option>
                        <option value="2" <?php echo (isset($_GET['estado']) && $_GET['estado'] == '2') ? 'selected' : ''; ?>>Cerrada</option>
                        <option value="3" <?php echo (isset($_GET['estado']) && $_GET['estado'] == '3') ? 'selected' : ''; ?>>Pausada</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="modalidad">Modalidad</label> 
                    <select id="modalidad" name="modalidad">
                        <option value="">Todas</option>
                        <option value="1" <?php echo (isset($_GET['modalidad']) && $_GET['modalidad'] == '1') ? 'selected' : ''; ?>>Presencial</option>
                        <option value="2" <?php echo (isset($_GET['modalidad']) && $_GET['modalidad'] == '2') ? 'selected' : ''; ?>>Remoto</option>
                        <option value="3" <?php echo (isset($_GET['modalidad']) && $_GET['modalidad'] == '3') ? 'selected' : ''; ?>>Híbrido</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">🔍 Buscar</button> 
                    <a href="?idEmpresa=<?php echo $idEmpresa; ?>" class="btn-clear">✖ Limpiar</a>
                </div>
            </form>
        </div>

        <div class="results-header">
            <div class="results-count">
                Mostrando: <span><?php echo count($listar); ?></span> vacantes
            </div>
        </div>

        <div class="vacancies-grid">
            <?php if (empty($listar)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>No hay vacantes encontradas</h3>
                    <p>Intenta con otros filtros o publica una nueva vacante.</p>
                </div>
            <?php else: ?>
                <?php foreach ($listar as $v): ?>
                    <div class="vacancy-card">
                        <div class="vacancy-header">
                            <div class="vacancy-title">
                                <h3><?php echo htmlspecialchars($v['tituloVacante']); ?></h3>
                                <div class="vacancy-id">ID: <?php echo $v['idVacante']; ?></div>
                            </div>
                            <?php 
                                $statusClass = match((int)$v['idEstadoVacante']) { 1 => 'abierta', 2 => 'cerrada', 3 => 'pausada', default => 'default' };
                            ?>
                            <span class="vacancy-status status-<?php echo $statusClass; ?>">
                                <?php echo $v['estadoNombre'] ?? 'Estado'; ?>
                            </span>
                        </div>

                        <div class="vacancy-details">
                            <div class="detail-item">📍 <?php echo htmlspecialchars($v['ubicacion'] ?? 'No definida'); ?></div>
                            <div class="detail-item">💰 $<?php echo number_format($v['salario'] ?? 0, 2); ?></div>
                            <div class="detail-item">📅 Límite: <?php echo $v['fechaLimite'] ?? 'N/A'; ?></div>
                        </div>

                        <div class="vacancy-footer">
                            <div class="posted-date">📅 Publicado: <?php echo $v['fechaPublicacion'] ?? '-'; ?></div>
                            <div class="vacancy-actions">
                                <a href="detalle-vacante.php?id=<?php echo $v['idVacante']; ?>" class="btn-details">Detalles</a>
                                <a href="editar-vacante.php?id=<?php echo $v['idVacante']; ?>" class="btn-edit">✏️</a>
                                <form method="POST" action="eliminar-vacante.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $v['idVacante']; ?>">
                                    <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar?')">🗑️</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>