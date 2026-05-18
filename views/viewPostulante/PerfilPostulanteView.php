<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
require_once __DIR__ ."/../../usecase/Postulantes/PostulantesController.php";

// Protection de sesión
$idUsuario = $_SESSION["idUsuarios"] ?? null;

if (!$idUsuario) {
    header("Location: /FutureWork_ITT/");
    exit;
}

/* Controladores */
$usuarioController = new UsuarioController();
$postulanteController = new PostulantesController();

/* 1. Obtener datos de Usuario (como fallback) */
$datosUsuario = [];
$resultUsuario = $usuarioController->obtenerUsuarioPorId($idUsuario);
if ($resultUsuario && strtolower($resultUsuario->status ?? '') === "ok") {
    $datosUsuario = (array) $resultUsuario->body;
}

/* 2. Obtener Perfil Completo del Postulante (Tu nuevo método) */
/* 2. Obtener Perfil Completo del Postulante (Tu consulta optimizada) */
$rawPerfil = $postulanteController->PerfilPostulante($idUsuario); 

$perfilBase = [];
$habilidades = [];
$certificaciones = [];

if ($rawPerfil && strtolower($rawPerfil->status ?? '') === "ok" && !empty($rawPerfil->body)) {
    
    // Al usar GROUP BY, extraemos la única fila desde el BODY del objeto
    $perfilBase = is_object($rawPerfil->body) ? (array) $rawPerfil->body : $rawPerfil->body;

    // Rompemos el string separado por comas en un array limpio
    if (!empty($perfilBase['Habilidades'])) {
        $habilidades = explode(',', $perfilBase['Habilidades']);
    }

    if (!empty($perfilBase['Certificaciones'])) {
        $certificaciones = explode(',', $perfilBase['Certificaciones']);
    }
    
} else {
    $perfilBase = [
        'nombreCompleto' => $datosUsuario['nombreCompleto'] ?? 'Usuario',
        'email' => $datosUsuario['correo'] ?? '',
        'nombreCarrera' => 'No asignada aún'
    ];
}
?>

<link rel="stylesheet" href="css/PerfilPostulanteView.css">

<div class="profile-view-wrapper">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>

    <header class="profile-header">
        <div class="profile-header-content">
            
            <div class="profile-header-left">
                <div class="hero-badge-profile">
                    ✨ Perfil Inteligente Klivify
                </div>

                <h1>
                    Bienvenido,
                    <span>
                        <?php echo htmlspecialchars($perfilBase["nombreCompleto"] ?? "Usuario"); ?>
                    </span>
                </h1>

                <p>
                    Administra tu información profesional, habilidades y postulaciones desde una experiencia moderna e intuitiva.
                </p>

                <div class="hero-buttons-profile">
                    <a href="?cargar=EditarPerfilPostulanteView" class="btn-profile-primary">
                        ✏️ Editar Perfil
                    </a>
                    <a href="?cargar=VacantesListView" class="btn-profile-secondary">
                        🚀 Explorar Vacantes
                    </a>
                </div>
            </div>

            <div class="hero-avatar-profile">
                <div class="avatar-circle-profile">
                    👨‍💻
                </div>
            </div>

        </div>
    </header>

    <main class="profile-container-custom">
        <div class="profile-layout">

            <aside class="sidebar-card-profile">
                <div class="profile-image-container-custom">
                    <div class="profile-image-placeholder-custom">
                        👤
                    </div>
                </div>

                <h2 class="user-name-profile">
                    <?php echo htmlspecialchars($perfilBase["nombreCompleto"] ?? "Usuario"); ?>
                </h2>

                <p class="user-career-profile">
                    🎓 <?php echo htmlspecialchars($perfilBase["nombreCarrera"] ?? "No especificada"); ?>
                </p>

                <span class="profile-status-tag">
                    ✓ Perfil Activo
                </span>

                <div class="sidebar-stats-grid">
                    <div class="sidebar-stat-card">
                        <h3>12</h3>
                        <p>Postulaciones</p>
                    </div>
                    <div class="sidebar-stat-card">
                        <h3>4</h3>
                        <p>Entrevistas</p>
                    </div>
                </div>

                <div class="sidebar-actions-profile">
                    <a href="?cargar=VacantesListView" class="sidebar-btn-custom primary-btn">
                        🔍 Buscar Vacantes
                    </a>
                    <a href="?cargar=MisPostulacionesView" class="sidebar-btn-custom secondary-btn">
                        📋 Mis Postulaciones
                    </a>
                    <a href="#" class="sidebar-btn-custom success-btn">
                        📄 Descargar CV
                    </a>
                </div>
            </aside>

            <section class="content-section-profile">

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>📋 Información Personal</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ✏️ Editar
                        </a>
                    </div>

                    <div class="info-grid-profile">
                        <div class="info-item-profile">
                            <span class="label-profile">Nombre Completo</span>
                            <span class="value-profile">
                                <?php echo htmlspecialchars($perfilBase["nombreCompleto"] ?? "No disponible"); ?>
                            </span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Correo Electrónico</span>
                            <span class="value-profile">
                                📧 <?php echo htmlspecialchars($perfilBase["email"] ?? "No disponible"); ?>
                            </span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Teléfono</span>
                            <span class="value-profile">📞 2381705916</span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Dirección</span>
                            <span class="value-profile">📍 Tehuacán, Puebla, México</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>🎓 Información Académica</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ✏️ Editar
                        </a>
                    </div>

                    <div class="info-grid-profile">
                        <div class="info-item-profile">
                            <span class="label-profile">Carrera Universitaria</span>
                            <span class="value-profile">
                                <?php echo htmlspecialchars($perfilBase["nombreCarrera"] ?? "No registrada"); ?>
                            </span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Rol en Plataforma</span>
                            <span class="value-profile">
                                🔑 <?php echo htmlspecialchars($perfilBase["nombreRol"] ?? "Postulante"); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>💡 Habilidades Profesionales</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ➕ Agregar
                        </a>
                    </div>
                    <div class="skills-container-profile">
                        <?php if (!empty($habilidades)): ?>
                            <?php foreach ($habilidades as $habilidad): ?>
                                <span class="skill-tag-profile">
                                    <?php echo htmlspecialchars($habilidad); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-white opacity-50 small my-2">No has añadido habilidades a tu perfil todavía.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>🏆 Certificaciones Obtenidas</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ➕ Agregar
                        </a>
                    </div>
                    <div class="certifications-grid-profile">
                        <?php if (!empty($certificaciones)): ?>
                            <?php foreach ($certificaciones as $certificacion): ?>
                                <div class="cert-card-profile">
                                    🎓 <?php echo htmlspecialchars($certificacion); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-white opacity-50 small my-2">No registras certificaciones vigentes.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>💼 Experiencia Profesional</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ➕ Agregar
                        </a>
                    </div>
                    <div class="profile-timeline">
                        <div class="timeline-item-profile">
                            <div class="timeline-icon-profile">🚀</div>
                            <div class="timeline-content-profile">
                                <h4>Frontend Developer</h4>
                                <p>Klivify Labs</p>
                                <span>2024 - Actualidad</span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>
</div>