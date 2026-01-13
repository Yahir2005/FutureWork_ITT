<?php
  session_start(); // Asegúrate de iniciar la sesión si no está en un archivo padre
  $MessageID = "";
  
  // Validar sesión
  if (!isset($_SESSION["idUsuarios"])) {
      // Redireccionar si no hay sesión (opcional)
      // header("Location: login.php");
      // exit();
      $idUsuario = 0; // Valor por defecto para evitar errores
  } else {
      $idUsuario = $_SESSION["idUsuarios"];
  }

  /**Agregar direcciones*/
  require_once __DIR__ . '/../../usecase/Usuario/UsuarioController.php';
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

  /**Instancias */
  $usuarioController = new UsuarioController();
  $vacanteController = new VacanteController();

  /**Arrays */
  $listaVacantes = array();
  
  /**Métodos */
  // Obtener datos de la empresa vinculada al usuario
  $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
  
  $idEmpresa = null;
  // Validar que se obtuvieron datos correctamente
  if ($result && isset($result->body) && isset($result->body['empresaId'])) {
      $datos = $result->body;
      $idEmpresa = $datos['empresaId'];
  }

  // Inicializar contadores en 0 por defecto
  $totalAprobadas = 0;
  $totalPausadas = 0;
  $totalCerradas = 0;
  $totalGeneral = 0;

  if($idEmpresa != null){
      $MessageID = "El usuario es una Empresa con ID: " . $idEmpresa;
      
      // Obtener lista de vacantes
      $vacantes = $vacanteController->ListarVacantesPorEmpresa($idEmpresa);
      if($vacantes->status == "ok"){
        $listaVacantes = $vacantes->body;
      }

      // Obtener contadores (asumiendo que los métodos devuelven un objeto con propiedad body)
      $resultVacantePausa = $vacanteController->contarVacantesPausadasPorEmpresa($idEmpresa);
      $resultVacanteAbierta = $vacanteController->contarVacantesAbiertasPorEmpresa($idEmpresa);
      $resultVacanteCerrada = $vacanteController->contarVacantesCerradasPorEmpresa($idEmpresa);
      $resultVacantesTotal = $vacanteController->contarVacantesPorEmpresa($idEmpresa);

      // Asignar valores si existen
      $totalPausadas = $resultVacantePausa->body ?? 0;
      $totalAprobadas = $resultVacanteAbierta->body ?? 0;
      $totalCerradas = $resultVacanteCerrada->body ?? 0;
      $totalGeneral = $resultVacantesTotal->body ?? 0;



$eliminarVacante= $vacanteController;

$mensaje ="";

// 1. Verificar si el formulario de eliminación ha sido enviado
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_vacante'])) {
      // 2. Validar y sanear la entrada del ID
      $id_a_eliminar = filter_input(INPUT_POST, 'id_Vacante_Eliminar', FILTER_SANITIZE_NUMBER_INT);

      if ($id_a_eliminar) {
          try {
              $resultado= $eliminarVacante->EliminarVacante($id_a_eliminar);
                    if($resultado->status == "ok"){
                      header("Location:http://localhost/FutureWork_ITT/views/viewEmpresa/navbarEmpresa.php?cargar=MisVacantesListView");
                      exit;
        }
          } catch (PDOException $e) {
              
          }
      } else {

      }
    }

  }
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Mis Vacantes</title>
  <link rel="stylesheet" href="css/MisVacantesListView.css">
  <style>
    @view-transition {
      navigation: auto;
    }
  </style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body><header class="header">
    <div class="header-content">
      <div class="header-top">
        <div class="header-text">
          <h1>💼 Mis Vacantes Publicadas</h1>
          <p>Administra las ofertas laborales de tu empresa</p>
        </div><a href="?cargar=VacantesAddView" class="btn-add">➕ Publicar Nueva Vacante</a>
      </div><div class="stats-container">
        <div class="stat-card">
          <div class="stat-label">
            📊 Total de Vacantes
          </div>
          <div class="stat-value">
            <?php echo $totalGeneral; ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ✅ Aprobadas
          </div>
          <div class="stat-value">
            <?php echo $totalAprobadas; ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ⏳ En Pausa
          </div>
          <div class="stat-value">
            <?php echo $totalPausadas; ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            ❌ Rechazadas/Cerradas
          </div>
          <div class="stat-value">
            <?php echo $totalCerradas; ?>
          </div>
        </div>
      </div>
    </div>
  </header><main class="container">
    

    <div class="results-header">
      <div class="results-count">
        Mostrando: <span><?php echo count($listaVacantes); ?></span> vacantes
      </div>

    </div>

    <?php if (count($listaVacantes) > 0): ?>
      
      <div class="vacancies-grid">
        <?php foreach ($listaVacantes as $vacante): ?>
          <div class="vacancy-card">
            <div class="vacancy-header">
              <div class="vacancy-title">
                <h3><?php echo htmlspecialchars($vacante['titulo']); ?></h3>
                <div class="vacancy-id">ID: #<?php echo htmlspecialchars($vacante['idVacante'] ?? 'N/A'); ?></div>
              </div>
              
              <span class="tag contract">
                <?php echo htmlspecialchars($vacante['estadoValidacionVacante']); ?>
              </span>
            </div>

            <div class="vacancy-details">
              <div class="detail-item">
                <span class="detail-label">📍 Ubicación:</span>
                <span class="detail-value"><?php echo htmlspecialchars($vacante['ubicacion']); ?></span>
              </div>
              <div class="detail-item">
                <span class="detail-label">💰 Salario:</span>
                <span class="detail-value salary">$ <?php echo htmlspecialchars($vacante['salario']); ?></span>
              </div>
              <div class="detail-item">
                <span class="detail-label">📅 Límite:</span>
                <span class="detail-value"><?php echo htmlspecialchars($vacante['fechaLimite']); ?></span>
              </div>
            </div>

            <p class="vacancy-description">
              <?php echo htmlspecialchars($vacante['descripcion']); ?>
            </p>
            <div class="vacancy-description">
            <div class="detail-item">* Requisitos: <br /><?php echo htmlspecialchars($vacante['requisitos']); ?></div>
            </div>
            <br />

            <div class="vacancy-tags">
              <span class="tag contract"><?php echo htmlspecialchars($vacante['estadoContrato']); ?></span>
              <span class="tag modality"><?php echo htmlspecialchars($vacante['tipoModalidad']); ?></span>
            </div>

            <div class="vacancy-footer">
              <div class="dates-info">
                <div class="date-item">
                  📅 Publicado: <strong><?php echo htmlspecialchars($vacante['fechaPublicacion']); ?></strong>
                </div>
              </div>
              <div class="vacancy-actions">

                    <a href="?cargar=VacantesEditView&id=<?php echo $vacante['idVacante'] ?? 0; ?>" class="btn-edit">✏️ Editar</a>
                
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?cargar=MisVacantesListView"; ?>" style="display:inline;">
                    <input type="hidden" name="id_Vacante_Eliminar" value="<?php echo $vacante['idVacante'] ?? 0; ?>">
                    <button type="submit"  name="eliminar_vacante" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta vacante?')">🗑️ Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      
      <div class="empty-state">
        <div class="empty-state-icon">
          📭
        </div>
        <h3>Tu empresa no tiene vacantes publicadas</h3>
        <p>Comienza a publicar ofertas laborales de tu empresa y encuentra a los mejores candidatos.</p>
        <a href="agregar-vacante.html" class="btn-add">➕ Publicar Primera Vacante de la Empresa</a>
      </div>

    <?php endif; ?>

  </main>
  <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'9a158e8da55ab1f2',t:'MTc2MzYxNjY0Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
</body>

</html>