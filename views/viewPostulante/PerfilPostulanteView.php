<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

// ✅ Protección de sesión
$idUsuario = $_SESSION["idUsuarios"] ?? null;

if (!$idUsuario) {
    header("Location: /FutureWork_ITT/");
    exit;
}

/* Variables */
$datosUsuario = [];
$datosPostulante = [];
$nombreCarrera = "Ingeniería en Sistemas Computacionales";

/* Controladores */
$usuarioController = new UsuarioController();

/* Usuario */
$resultUsuario = $usuarioController->obtenerUsuarioPorId($idUsuario);

if ($resultUsuario && strtolower($resultUsuario->status ?? '') === "ok") {
    $datosUsuario = (array) $resultUsuario->body;
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Klivify - Perfil Profesional</title>

  <!-- CSS -->
  <link rel="stylesheet" href="css/PerfilPostulanteView.css">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    @view-transition {
      navigation: auto;
    }
  </style>
</head>

<body>

<!-- Fondo decorativo -->
<div class="bg-orb orb-1"></div>
<div class="bg-orb orb-2"></div>
<div class="bg-orb orb-3"></div>

<!-- HEADER -->
<header class="header">

  <div class="header-content">

    <div class="header-left">
      <div class="hero-badge">
        ✨ Perfil Inteligente Klivify
      </div>

      <h1>
        Bienvenido,
        <span>
          <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "Usuario"); ?>
        </span>
      </h1>

      <p>
        Administra tu información profesional, habilidades y postulaciones desde una experiencia moderna e intuitiva.
      </p>

      <div class="hero-buttons">

        <!-- ✅ REDIRECCION EDITAR PERFIL -->
        <a href="?cargar=EditarPerfilPostulanteView" class="btn-primary">
          ✏️ Editar Perfil
        </a>

        <!-- ✅ REDIRECCION VACANTES -->
        <a href="?cargar=VacantesListView" class="btn-secondary">
          🚀 Explorar Vacantes
        </a>

      </div>
    </div>

    <!-- Avatar 3D -->
    <div class="hero-avatar">
      <div class="avatar-circle">
        👨‍💻
      </div>
    </div>

  </div>
</header>

<!-- MAIN -->
<main class="container">

  <div class="profile-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar-card">

      <div class="profile-image-container">

        <div class="profile-image-placeholder">
          👤
        </div>

      </div>

      <h2 class="user-name">
        <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "Usuario"); ?>
      </h2>

      <p class="user-career">
        🎓 <?php echo htmlspecialchars($nombreCarrera); ?>
      </p>

      <span class="profile-status">
        ✓ Perfil Activo
      </span>

      <!-- Stats -->
      <div class="stats-grid">

        <div class="stat-card">
          <h3>12</h3>
          <p>Postulaciones</p>
        </div>

        <div class="stat-card">
          <h3>4</h3>
          <p>Entrevistas</p>
        </div>

      </div>

      <!-- Acciones -->
      <div class="sidebar-actions">

        <!-- ✅ REDIRECCION VACANTES -->
        <a href="?cargar=VacantesListView" class="sidebar-btn primary">
          🔍 Buscar Vacantes
        </a>

        <!-- ✅ REDIRECCION POSTULACIONES -->
        <a href="?cargar=MisPostulacionesView" class="sidebar-btn secondary">
          📋 Mis Postulaciones
        </a>

        <a href="#" class="sidebar-btn success">
          📄 Descargar CV
        </a>

      </div>

    </aside>

    <!-- CONTENT -->
    <section class="content-section">

      <!-- PERSONAL -->
      <div class="glass-card">

        <div class="card-header">
          <h3>📋 Información Personal</h3>

          <!-- ✅ REDIRECCION -->
          <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn">
            ✏️ Editar
          </a>
        </div>

        <div class="info-grid">

          <div class="info-item">
            <span class="label">Nombre Completo</span>
            <span class="value">
              <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "No disponible"); ?>
            </span>
          </div>

          <div class="info-item">
            <span class="label">Correo Electrónico</span>

            <span class="value">
              📧 <?php echo htmlspecialchars($datosUsuario["correo"] ?? "correo@klivify.com"); ?>
            </span>
          </div>

          <div class="info-item">
            <span class="label">Teléfono</span>
            <span class="value">
              📞 2381705916
            </span>
          </div>

          <div class="info-item">
            <span class="label">Dirección</span>
            <span class="value">
              📍 Tehuacán, Puebla, México
            </span>
          </div>

          <div class="info-item">
            <span class="label">Miembro Desde</span>
            <span class="value">
              📅 2025
            </span>
          </div>

        </div>

      </div>

      <!-- ACADEMICO -->
      <div class="glass-card">

        <div class="card-header">
          <h3>🎓 Información Académica</h3>

          <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn">
            ✏️ Editar
          </a>
        </div>

        <div class="info-grid">

          <div class="info-item">
            <span class="label">Carrera</span>
            <span class="value">
              <?php echo htmlspecialchars($nombreCarrera); ?>
            </span>
          </div>

          <div class="info-item">
            <span class="label">Número de Control</span>
            <span class="value">
              🎓 22123456
            </span>
          </div>

          <div class="info-item">
            <span class="label">Estado Académico</span>
            <span class="value">
              ✅ Activo
            </span>
          </div>

          <div class="info-item">
            <span class="label">Currículum</span>
            <span class="value">
              📄 Disponible
            </span>
          </div>

        </div>

      </div>

      <!-- HABILIDADES -->
      <div class="glass-card">

        <div class="card-header">
          <h3>💡 Habilidades</h3>

          <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn">
            ➕ Agregar
          </a>
        </div>

        <div class="skills-container">

          <span class="skill-tag">HTML5</span>
          <span class="skill-tag">CSS3</span>
          <span class="skill-tag">JavaScript</span>
          <span class="skill-tag">PHP</span>
          <span class="skill-tag">MySQL</span>
          <span class="skill-tag">UI/UX</span>
          <span class="skill-tag">Git</span>
          <span class="skill-tag">Tailwind</span>

        </div>

      </div>

      <!-- EXPERIENCIA -->
      <div class="glass-card">

        <div class="card-header">
          <h3>💼 Experiencia Profesional</h3>

          <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn">
            ➕ Agregar
          </a>
        </div>

        <div class="timeline">

          <div class="timeline-item">

            <div class="timeline-icon">
              🚀
            </div>

            <div class="timeline-content">
              <h4>Frontend Developer</h4>
              <p>Klivify Labs</p>
              <span>2024 - Actualidad</span>
            </div>

          </div>

          <div class="timeline-item">

            <div class="timeline-icon">
              💻
            </div>

            <div class="timeline-content">
              <h4>UI Designer</h4>
              <p>Creative Studio</p>
              <span>2023 - 2024</span>
            </div>

          </div>

        </div>

      </div>

      <!-- CERTIFICACIONES -->
      <div class="glass-card">

        <div class="card-header">
          <h3>🏆 Certificaciones</h3>

          <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn">
            ➕ Agregar
          </a>
        </div>

        <div class="certifications-grid">

          <div class="cert-card">
            🧠 JavaScript Advanced
          </div>

          <div class="cert-card">
            ☁️ AWS Cloud
          </div>

          <div class="cert-card">
            🎨 UI/UX Professional
          </div>

        </div>

      </div>

      <!-- POSTULACIONES -->
      <div class="glass-card">

        <div class="card-header">
          <h3>📨 Postulaciones Recientes</h3>

          <a href="?cargar=MisPostulacionesView" class="edit-btn">
            Ver Todas
          </a>
        </div>

        <div class="applications-list">

          <div class="application-card">

            <div>
              <h4>Frontend Developer</h4>
              <p>Klivify Tech</p>
            </div>

            <span class="status reviewing">
              🔍 En revisión
            </span>

          </div>

          <div class="application-card">

            <div>
              <h4>Diseñador UX/UI</h4>
              <p>Creative Labs</p>
            </div>

            <span class="status accepted">
              ✅ Aceptada
            </span>

          </div>

        </div>

      </div>

    </section>

  </div>

</main>

</body>
</html>