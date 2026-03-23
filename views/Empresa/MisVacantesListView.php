<?php
    session_start();
    $MessageID = "";
    /*Direcciones */
    require_once __DIR__ ."/../../usecase/Vacantes/VacanteController.php";
    require_once __DIR__ ."/../../usecase/Usuario/UsuarioController.php";
    
    /*Validar sesión */
    if (!isset($_SESSION["idUsuarios"])) {

      $idUsuario = 0; 
    } else {
        $idUsuario = $_SESSION["idUsuarios"];
    }
    /*Controladores */
    $usuarioController = new UsuarioController();
    $vacanteController = new VacanteController();

    /**Arrays */
    $listaVacantes = array();

    /**Metodos */
    $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
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

    // Obtener contadores
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
                    $mensaje = "Error al eliminar la vacante.";
                }
            } else {
                $mensaje = "ID de vacante inválido.";
            }
        }
    }
?>

<header class="bg-primary text-white py-4">
  <div class="container">
    <!-- Encabezado superior -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1">💼 Mis Vacantes Publicadas</h1>
        <p class="mb-0">Administra las ofertas laborales de tu empresa</p>
      </div>
      <a href="?cargar=VacantesAddView" class="btn btn-light">
        ➕ Publicar Nueva Vacante
      </a>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row text-center">
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">📊 Total de Vacantes</div>
            <div class="display-6"><?php echo $totalGeneral; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">✅ Aprobadas</div>
            <div class="display-6"><?php echo $totalAprobadas; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">⏳ En Pausa</div>
            <div class="display-6"><?php echo $totalPausadas; ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-light shadow-sm">
          <div class="card-body">
            <div class="fw-bold">❌ Rechazadas/Cerradas</div>
            <div class="display-6"><?php echo $totalCerradas; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- -->

<div class="p-5">

<?php if (count($listaVacantes) > 0): ?>
  <div class="row">
    <?php foreach ($listaVacantes as $vacante): ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex flex-column">
            <!-- Encabezado -->
            <div class="d-flex justify-content-between align-items-start mb-2">
              <div>
                <h5 class="card-title mb-1">
                  <?php echo htmlspecialchars($vacante['titulo']); ?>
                </h5>
                <small class="text-muted">ID: #<?php echo htmlspecialchars($vacante['idVacante'] ?? 'N/A'); ?></small>
              </div>
              <span class="badge bg-primary">
                <?php echo htmlspecialchars($vacante['estadoValidacionVacante']); ?>
              </span>
            </div>

            <!-- Detalles -->
            <ul class="list-unstyled mb-3">
              <li><strong>📍 Ubicación:</strong> <?php echo htmlspecialchars($vacante['ubicacion']); ?></li>
              <li><strong>💰 Salario:</strong> $<?php echo htmlspecialchars($vacante['salario']); ?></li>
              <li><strong>📅 Límite:</strong> <?php echo htmlspecialchars($vacante['fechaLimite']); ?></li>
            </ul>

            <!-- Descripción -->
            <p class="card-text flex-grow-1">
              <?php echo htmlspecialchars($vacante['descripcion']); ?>
            </p>
            <p class="small"><strong>* Requisitos:</strong><br><?php echo htmlspecialchars($vacante['requisitos']); ?></p>

            <!-- Tags -->
            <div class="mb-3">
              <span class="badge bg-success"><?php echo htmlspecialchars($vacante['estadoContrato']); ?></span>
              <span class="badge bg-info text-dark"><?php echo htmlspecialchars($vacante['tipoModalidad']); ?></span>
            </div>

            <!-- Footer -->
            <div class="d-flex justify-content-between align-items-center mt-auto">
              <small class="text-muted">📅 Publicado: <strong><?php echo htmlspecialchars($vacante['fechaPublicacion']); ?></strong></small>
              <div class="btn-group">
                <a href="?cargar=VacantePostulantes&id=<?php echo $vacante['idVacante'] ?? 0; ?>" class="btn btn-sm btn-outline-primary">Ver Postulantes</a>
                <a href="?cargar=VacantesEditView&id=<?php echo $vacante['idVacante'] ?? 0; ?>" class="btn btn-sm btn-outline-secondary">✏️ Editar</a>
                <!-- Botón eliminar vacante -->
                <button type="button" class="btn btn-sm btn-outline-danger" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmDeleteModal"
                        data-id="<?php echo $vacante['idVacante'] ?? 0; ?>">
                🗑️ Eliminar
                </button>

                <!-- Modal de confirmación -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de eliminar esta vacante? Esta acción no se puede deshacer.
                        </div>
                        <div class="modal-footer">
                            <form id="deleteForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?cargar=MisVacantesListView"; ?>">
                            <input type="hidden" name="id_Vacante_Eliminar" id="vacanteIdEliminar" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="eliminar_vacante" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="text-center py-5">
    <div class="fs-1 mb-3">📭</div>
    <h3>Tu empresa no tiene vacantes publicadas</h3>
    <p class="text-muted">Comienza a publicar ofertas laborales de tu empresa y encuentra a los mejores candidatos.</p>
    <a href="agregar-vacante.html" class="btn btn-primary">➕ Publicar Primera Vacante de la Empresa</a>
  </div>
<?php endif; ?>

</div>
