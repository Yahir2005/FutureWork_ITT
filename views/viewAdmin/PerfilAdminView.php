<?php
$MessageID = "";
require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";

/** Extraer el ID de la empresa */
$idUsuario = $_SESSION["idUsuarios"] ?? null;
  
$EmpresaController = new EmpresaController();
$result = $EmpresaController->obtenerEmpresaPorIdUsuario($idUsuario);
$datosEmpresa = (strtolower($result->status) == 'ok') ? $result->body : [];
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Perfil de Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
  </style>
</head>
<body>

  <?php if (!empty($datosEmpresa)): ?>
    <?php foreach ($datosEmpresa as $empresa): ?>
      
      <header class="bg-primary text-white py-4 mb-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
          <div>
            <h1 class="h3 mb-1">🏢 Perfil de la Empresa</h1>
            <p class="mb-0">Información completa de la empresa</p>
          </div>
          <a href="?cargar=EmpresaEditView&id=<?php echo htmlspecialchars($empresa['idEmpresas']); ?>" class="btn btn-light text-primary fw-bold shadow-sm">
            ✏️ Editar Perfil
          </a>
        </div>
      </header>

      <main class="container pb-5">
        <div class="row g-4">
          
          <div class="col-12 col-lg-4">
            <aside class="card shadow-sm border-0 text-center h-100">
              <div class="card-body p-4 d-flex flex-column align-items-center">
                
                <?php if (!empty($empresa['urlImagenPerfilEmpresa'])): ?>
                  <img src="<?php echo htmlspecialchars($empresa['urlImagenPerfilEmpresa']); ?>" 
                       alt="Logo de <?php echo htmlspecialchars($empresa['nombreEmpresa']); ?>" 
                       class="rounded-circle mb-3 shadow-sm object-fit-cover" 
                       style="width: 120px; height: 120px; border: 3px solid #f8f9fa;">
                <?php else: ?>
                  <div class="profile-avatar bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 120px; height: 120px; font-size: 3.5rem;">
                    🏢
                  </div>
                <?php endif; ?>
                
                <h3 class="card-title h4 fw-bold mb-1">
                  <?php echo htmlspecialchars($empresa['nombreEmpresa'] ?? 'Empresa sin nombre'); ?>
                </h3>
                <p class="text-muted mb-3">
                  <?php echo htmlspecialchars($empresa['sector'] ?? 'Sector no definido'); ?>
                </p>

                <?php 
                  $estadoStr = strtolower($empresa['estadoValidacionEmpresa'] ?? '');
                  $badgeClass = 'bg-secondary';
                  if (str_contains($estadoStr, 'pend')) $badgeClass = 'bg-warning text-dark';
                  if (str_contains($estadoStr, 'apro') || str_contains($estadoStr, 'vali')) $badgeClass = 'bg-success';
                  if (str_contains($estadoStr, 'rech')) $badgeClass = 'bg-danger';
                ?>
                <span class="badge <?php echo $badgeClass; ?> rounded-pill px-3 py-2 mb-4">
                  <?php echo htmlspecialchars($empresa['estadoValidacionEmpresa'] ?? 'Desconocido'); ?>
                </span>

                <div class="d-grid gap-2 w-100 mt-auto">
                  <a href="?cargar=MisVacantesListView" class="btn btn-primary">📋 Ver Mis Vacantes</a>
                  <a href="?cargar=VacantesAddView" class="btn btn-outline-primary">➕ Publicar Vacante</a>
                  <a href="?cargar=EditarFotoEmpresaView&id=<?php echo htmlspecialchars($empresa['idEmpresas']); ?>" class="btn btn-link text-decoration-none mt-2">📷 Actualizar Logo</a>
                </div>

              </div>
            </aside>
          </div>

          <div class="col-12 col-lg-8">
            <div class="d-flex flex-column gap-4">

              <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                    <h4 class="card-title h5 m-0">📊 Información General</h4>
                    <a href="?cargar=EmpresaEditView&id=<?php echo htmlspecialchars($empresa['idEmpresas']); ?>" class="btn btn-sm btn-outline-secondary">✏️ Editar</a>
                  </div>

                  <div class="row g-4">
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">ID de Empresa</div>
                      <div class="fs-6"><?php echo htmlspecialchars($empresa['idEmpresas'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Representante Legal</div>
                      <div class="fs-6"><?php echo htmlspecialchars($empresa['representante'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Sector Industrial</div>
                      <div class="fs-6"><?php echo htmlspecialchars($empresa['sector'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Sitio Web</div>
                      <div class="fs-6 text-truncate">
                        <?php if (!empty($empresa['sitioWeb'])): ?>
                          <a href="<?php echo htmlspecialchars($empresa['sitioWeb']); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                            🌐 Visitar Sitio Web
                          </a>
                        <?php else: ?>
                          N/A
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                    <h4 class="card-title h5 m-0">📝 Acerca de <?php echo htmlspecialchars($empresa['nombreEmpresa']); ?></h4>
                    <a href="?cargar=EmpresaEditView&id=<?php echo htmlspecialchars($empresa['idEmpresas']); ?>" class="btn btn-sm btn-outline-secondary">✏️ Editar</a>
                  </div>
                  <p class="card-text text-secondary mb-0" style="white-space: pre-wrap;">
                    <?php echo htmlspecialchars($empresa['descripcion'] ?? 'No hay descripción disponible.'); ?>
                  </p>
                </div>
              </div>

              <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                    <h4 class="card-title h5 m-0">📧 Información de Contacto</h4>
                    <a href="?cargar=EmpresaEditView&id=<?php echo htmlspecialchars($empresa['idEmpresas']); ?>" class="btn btn-sm btn-outline-secondary">✏️ Editar</a>
                  </div>

                  <div class="row g-4">
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Nombre de Contacto</div>
                      <div class="fs-6"><?php echo htmlspecialchars($empresa['nombreCompleto'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Correo Electrónico</div>
                      <div class="fs-6 text-truncate">
                        <?php if(!empty($empresa['email'])): ?>
                          <a href="mailto:<?php echo htmlspecialchars($empresa['email']); ?>" class="text-decoration-none">
                            📧 <?php echo htmlspecialchars($empresa['email']); ?>
                          </a>
                        <?php else: ?>
                          N/A
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">ID de Usuario</div>
                      <div class="fs-6"><?php echo htmlspecialchars($empresa['idUsuarios'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-muted small fw-bold text-uppercase">Tipo de Cuenta</div>
                      <div class="fs-6">👤 Empresa</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                    <h4 class="card-title h5 m-0">💼 Vacantes Recientes</h4>
                    <a href="?cargar=MisVacantesListView" class="btn btn-sm btn-outline-primary">Ver Todas</a>
                  </div>
                  
                  <div class="text-center py-5">
                    <div class="display-4 text-muted mb-3">📭</div>
                    <p class="text-muted fw-bold">No hay vacantes publicadas aún</p>
                    <a href="?cargar=VacantesAddView" class="btn btn-primary mt-2">➕ Publicar Primera Vacante</a>
                  </div>
                  
                </div>
              </div>

            </div>
          </div>

        </div>
      </main>

    <?php endforeach; ?>
  <?php else: ?>
    <div class="container mt-5">
      <div class="alert alert-warning shadow-sm" role="alert">
        <h4 class="alert-heading">No se encontró el perfil</h4>
        <p>No se pudieron cargar los datos de la empresa para el usuario actual. Por favor, verifica tu sesión o completa tu registro.</p>
      </div>
    </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>