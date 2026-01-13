<?php
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Postulaciones/PostulacionesController.php";
require_once __DIR__ . "/../../Dto/Postulaciones.php";
require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";

// Start session and get user info
SessionManager::startSession();
$mensaje = "";
$tipoMensaje = ""; // 'success' or 'error'

// Get user ID from session
$idUsuario = SessionManager::getUserId();
$idPostulante = null;

// Get postulante ID from user
if ($idUsuario) {
    $usuarioController = new UsuarioController();
    $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
    
    if ($result && strtolower($result->status) == "ok" && isset($result->body['postulanteId'])) {
        $idPostulante = $result->body['postulanteId'];
    }
}

// Handle postulation submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postular'])) {
    $idVacante = filter_input(INPUT_POST, 'idVacante', FILTER_SANITIZE_NUMBER_INT);
    
    if ($idPostulante && $idVacante) {
        $postulacionController = new PostulacionesController();
        $postulacion = new Postulaciones();
        
        // Estado 1 = "En revisión" (default state for new postulations)
        $estadoEnRevision = 1;
        
        $postulacion->set("Postulante_idPostulante", $idPostulante);
        $postulacion->set("Vacante_idVacante", $idVacante);
        $postulacion->set("EstadoPostulacion_idEstadoPostulacion", $estadoEnRevision);
        $postulacion->set("fechaPostulacion", date("Y-m-d H:i:s"));
        
        $response = $postulacionController->InsertarPostulacion($postulacion);
        
        if (strtolower($response->status) == "ok") {
            $mensaje = "¡Postulación exitosa! Tu solicitud ha sido registrada.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al procesar la postulación: " . htmlspecialchars($response->message);
            $tipoMensaje = "error";
        }
    } else {
        $mensaje = "Error: No se pudo identificar el postulante o la vacante.";
        $tipoMensaje = "error";
    }
}

$vacanteController = new VacanteController();

/**Contar total de vacantes */
$totalVacantes = $vacanteController->contarVacantes();
$totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
$totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
$totalVacantesPausadas = $vacanteController->contarVacantesPausadas();

// Get total counts
$totalVacantesCount = ($totalVacantes && isset($totalVacantes->body)) ? $totalVacantes->body : 0;
$totalVacantesAbiertasCount = ($totalVacantesAbiertas && isset($totalVacantesAbiertas->body)) ? $totalVacantesAbiertas->body : 0;
$totalVacantesCerradasCount = ($totalVacantesCerradas && isset($totalVacantesCerradas->body)) ? $totalVacantesCerradas->body : 0;
$totalVacantesPausadasCount = ($totalVacantesPausadas && isset($totalVacantesPausadas->body)) ? $totalVacantesPausadas->body : 0;

// --- Empresas ---
$listarVacantesCard = array();
$resultVacantes = $vacanteController->ListarVacantesTotalesCard() ;
if(strtolower($resultVacantes->status) == "ok"){
  $listarVacantesCard = $resultVacantes->body;
}




/**Controladores /**
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
  <script src="https://cdn.tailwindcss.com"></script>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <?php if ($mensaje): ?>
    <?php
    // Validate $tipoMensaje to prevent CSS injection
    $tipoMensajeClass = ($tipoMensaje === 'success') ? 'success' : 'error';
    $backgroundColor = ($tipoMensajeClass === 'success') ? '#4CAF50' : '#f44336';
    ?>
    <div class="alert alert-<?php echo $tipoMensajeClass; ?>" style="position: fixed; top: 20px; right: 20px; z-index: 1000; padding: 15px; border-radius: 5px; background-color: <?php echo $backgroundColor; ?>; color: white; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
      <?php echo htmlspecialchars($mensaje); ?>
      <button onclick="this.parentElement.remove()" style="margin-left: 10px; background: none; border: none; color: white; font-size: 20px; cursor: pointer;">&times;</button>
    </div>
    <script>
      setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) alert.remove();
      }, 5000);
    </script>
  <?php endif; ?>
  
  <!-- Header -->
  <header class="header">
   <div class="header-content"><!-- Stats Cards -->
    <div class="stats-container">
     <div class="stat-card">
      <div class="stat-label">
       📊 Total de Vacantes
      </div>
      <div class="stat-value">
       <?php echo $totalVacantesCount; ?>
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ✅ Vacantes Abiertas
      </div>
      <div class="stat-value">
       <?php echo $totalVacantesAbiertasCount; ?>
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ❌ Vacantes Cerradas
      </div>
      <div class="stat-value">
       <?php echo $totalVacantesCerradasCount; ?>
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ⏸️ Vacantes Pausadas
      </div>
      <div class="stat-value">
       <?php echo $totalVacantesPausadasCount; ?>
      </div>
     </div>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container">
    <?php if (count($listarVacantesCard) > 0): ?>
      <div class="vacancies-grid">
        <?php foreach ($listarVacantesCard as $vacante): ?>
          <div class="vacancy-card">
            <div class="vacancy-header">
              <div class="vacancy-title">
                <h3><?php echo htmlspecialchars($vacante['titulo'] ?? 'Sin título'); ?></h3>
                <div class="vacancy-id">
                  ID: <?php echo htmlspecialchars($vacante['idVacante'] ?? 'N/A'); ?>
                </div>
              </div>
              <span class="tag contract"><?php echo htmlspecialchars($vacante['estadoValidacionVacante'] ?? 'N/A'); ?></span>
            </div>
            
            <div class="vacancy-details">
              <div class="detail-item">
                📍 Ubicación: <?php echo htmlspecialchars($vacante['ubicacion'] ?? 'N/A'); ?>
              </div>
              <div class="detail-item">
                💰 Salario: $ <?php echo htmlspecialchars($vacante['salario'] ?? 'N/A'); ?>
              </div>
              <div class="detail-item">
                📅 Límite: <?php echo htmlspecialchars($vacante['fechaLimite'] ?? 'N/A'); ?>
              </div>
            </div>
            
            <p class="vacancy-description">
              <?php echo htmlspecialchars($vacante['descripcion'] ?? 'Sin descripción'); ?>
            </p>
            
            <div class="vacancy-footer">
              <div class="detail-item">
                * Requisitos: <br>
                <?php echo htmlspecialchars($vacante['requisitos'] ?? 'No especificados'); ?>
              </div>
            </div>
            <br>
            
            <div class="vacancy-tags">
              <span class="tag contract"><?php echo htmlspecialchars($vacante['estadoContrato'] ?? 'N/A'); ?></span>
              <span class="tag modality"><?php echo htmlspecialchars($vacante['tipoModalidad'] ?? 'N/A'); ?></span>
              <span class="tag salary">$ <?php echo htmlspecialchars($vacante['salario'] ?? 'N/A'); ?></span>
            </div>
            
            <div class="vacancy-footer">
              <div class="posted-date">
                📅 Publicado: <?php echo htmlspecialchars($vacante['fechaPublicacion'] ?? 'N/A'); ?>
              </div>
              <form method="POST" style="display: inline;">
                <input type="hidden" name="idVacante" value="<?php echo htmlspecialchars($vacante['idVacante'] ?? 0); ?>">
                <button type="submit" name="postular" class="btn-postular"> ✅ Postularme </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty-state" style="text-align: center; padding: 40px;">
        <div style="font-size: 48px; margin-bottom: 20px;">📭</div>
        <h3>No hay vacantes disponibles</h3>
        <p>Actualmente no hay vacantes publicadas. Vuelve pronto para ver nuevas oportunidades.</p>
      </div>
    <?php endif; ?>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd3274c7344f863',t:'MTc2ODI4OTA2Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>