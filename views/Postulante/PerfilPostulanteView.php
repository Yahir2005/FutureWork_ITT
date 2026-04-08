<?php
  require_once __DIR__ . "/../../usecase/Postulantes/PostulantesController.php";

  $idUsuario = $_SESSION["idUsuarios"];
    
  $PostulantesController = new PostulantesController();

  $result = $PostulantesController->ObtenerPostulantePorIdUsuario($idUsuario);
  
  $datosPostulante = ($result->status == "ok") ? $result->body : null;
?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        font-size: 3.5rem;
    }
    .card {
        border-radius: 12px;
    }
</style>

<?php if (!empty($datosPostulante)): ?>
    <header class="bg-primary text-white py-4 mb-4 shadow-sm">
        <div class="container">
          <h1 class="h3 mb-1">🎓 Mi Perfil Profesional</h1>
          <p class="mb-0">Gestiona tu información personal y académica</p>
        </div>
      </header>

    <main class="container pb-5">
        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <aside class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body p-4 d-flex flex-column align-items-center">
                        
                        <div class="profile-avatar bg-light text-primary rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm">
                            👨‍🎓
                        </div>
                        
                        <h3 class="card-title h4 fw-bold mb-1">
                            <?php echo htmlspecialchars($datosPostulante['nombreCompleto'] ?? 'Nombre no disponible'); ?>
                        </h3>
                        <p class="text-muted mb-3">
                            ID de Usuario: #<?php echo htmlspecialchars($datosPostulante['idUsuarios'] ?? 'N/A'); ?>
                        </p>

                        <span class="badge bg-info text-dark rounded-pill px-3 py-2 mb-4">
                            Egresado / Estudiante
                        </span>

                        <div class="w-100 d-flex justify-content-around mb-4 border-top border-bottom py-3">
                            <div>
                                <div class="fs-4 fw-bold text-primary">--</div>
                                <div class="small text-muted">Postulaciones</div>
                            </div>
                            <div class="border-end"></div>
                            <div>
                                <div class="fs-4 fw-bold text-success">Activo</div>
                                <div class="small text-muted">Estado</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 w-100 mt-auto">
                            <?php if (!empty($datosPostulante['cvPath'])): ?>
                                <a href="../../uploads/cv/<?php echo $datosPostulante['cvPath']; ?>" target="_blank" class="btn btn-primary">
                                    📄 Ver Mi CV Actual
                                </a>
                            <?php endif; ?>
                            <a href="?cargar=VacantesListView" class="btn btn-outline-primary">🔍 Buscar Vacantes</a>
                        </div>

                    </div>
                </aside>
            </div>

            <div class="col-12 col-lg-8">
                <div class="d-flex flex-column gap-4">

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="card-title h5 border-bottom pb-2 mb-4">📚 Datos Académicos</h4>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="text-muted small fw-bold text-uppercase">Número de Control</div>
                                    <div class="fs-6 fw-bold"><?php echo htmlspecialchars($datosPostulante['numeroControl'] ?? 'N/A'); ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted small fw-bold text-uppercase">Carrera</div>
                                    <div class="fs-6"><?php echo htmlspecialchars($datosPostulante['nombreCarrera'] ?? 'Carrera #'.$datosPostulante['Carrera_idCarrera']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="card-title h5 border-bottom pb-2 mb-4">📱 Información de Contacto</h4>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="text-muted small fw-bold text-uppercase">Correo Electrónico</div>
                                    <div class="fs-6">
                                        <a href="mailto:<?php echo $datosPostulante['email']; ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($datosPostulante['email'] ?? 'N/A'); ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted small fw-bold text-uppercase">Teléfono</div>
                                    <div class="fs-6"><?php echo htmlspecialchars($datosPostulante['telefono'] ?? 'N/A'); ?></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="text-muted small fw-bold text-uppercase">Ubicación Actual</div>
                                    <div class="fs-6">📍 <?php echo htmlspecialchars($datosPostulante['ubicacion'] ?? 'No especificada'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 border-start border-4 border-primary">
                        <div class="card-body p-4">
                            <h4 class="card-title h5 mb-3">📄 Currículum Vitae</h4>
                            <p class="text-muted small mb-3">Tu CV es visible para las empresas a las que te postulas.</p>
                            <div class="alert bg-light border mb-0 d-flex justify-content-between align-items-center">
                                <span class="text-truncate mr-2">
                                    <i class="bi bi-file-earmark-pdf"></i> 
                                    <?php echo !empty($datosPostulante['cvPath']) ? $datosPostulante['cvPath'] : 'No has subido ningún archivo aún.'; ?>
                                </span>
                                <button class="btn btn-sm btn-secondary">Actualizar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

<?php else: ?>
    <div class="container mt-5">
        <div class="alert alert-warning shadow-sm" role="alert">
            <h4 class="alert-heading">⚠️ Perfil no encontrado</h4>
            <p>No pudimos encontrar tus datos como postulante (ID buscado: <?php echo $idUsuario; ?>).</p>
            <hr>
            <p class="mb-0">Asegúrate de que tu registro esté completo en la base de datos.</p>
        </div>
    </div>
<?php endif; ?>
