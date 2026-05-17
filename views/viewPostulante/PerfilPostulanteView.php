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
                        <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "Usuario"); ?>
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
                    <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "Usuario"); ?>
                </h2>

                <p class="user-career-profile">
                    🎓 <?php echo htmlspecialchars($nombreCarrera); ?>
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
                                <?php echo htmlspecialchars($datosUsuario["nombreCompleto"] ?? "No disponible"); ?>
                            </span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Correo Electrónico</span>
                            <span class="value-profile">
                                📧 <?php echo htmlspecialchars($datosUsuario["correo"] ?? "correo@klivify.com"); ?>
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
                        <div class="info-item-profile">
                            <span class="label-profile">Miembro Desde</span>
                            <span class="value-profile">📅 2025</span>
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
                            <span class="label-profile">Carrera</span>
                            <span class="value-profile"><?php echo htmlspecialchars($nombreCarrera); ?></span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Número de Control</span>
                            <span class="value-profile">🎓 22123456</span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Estado Académico</span>
                            <span class="value-profile">✅ Activo</span>
                        </div>
                        <div class="info-item-profile">
                            <span class="label-profile">Currículum</span>
                            <span class="value-profile">📄 Disponible</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>💡 Habilidades</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ➕ Agregar
                        </a>
                    </div>
                    <div class="skills-container-profile">
                        <span class="skill-tag-profile">HTML5</span>
                        <span class="skill-tag-profile">CSS3</span>
                        <span class="skill-tag-profile">JavaScript</span>
                        <span class="skill-tag-profile">PHP</span>
                        <span class="skill-tag-profile">MySQL</span>
                        <span class="skill-tag-profile">UI/UX</span>
                        <span class="skill-tag-profile">Git</span>
                        <span class="skill-tag-profile">Tailwind</span>
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
                        <div class="timeline-item-profile">
                            <div class="timeline-icon-profile">💻</div>
                            <div class="timeline-content-profile">
                                <h4>UI Designer</h4>
                                <p>Creative Studio</p>
                                <span>2023 - 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>🏆 Certificaciones</h3>
                        <a href="?cargar=EditarPerfilPostulanteView" class="edit-btn-profile">
                            ➕ Agregar
                        </a>
                    </div>
                    <div class="certifications-grid-profile">
                        <div class="cert-card-profile">🧠 JavaScript Advanced</div>
                        <div class="cert-card-profile">☁️ AWS Cloud</div>
                        <div class="cert-card-profile">🎨 UI/UX Professional</div>
                    </div>
                </div>

                <div class="glass-card-profile">
                    <div class="profile-card-header">
                        <h3>📨 Postulaciones Recientes</h3>
                        <a href="?cargar=MisPostulacionesView" class="edit-btn-profile">
                            Ver Todas
                        </a>
                    </div>

                    <div class="applications-list-profile">
                        <div class="application-card-profile">
                            <div>
                                <h4>Frontend Developer</h4>
                                <p>Klivify Tech</p>
                            </div>
                            <span class="status-profile reviewing-status">🔍 En revisión</span>
                        </div>
                        <div class="application-card-profile">
                            <div>
                                <h4>Diseñador UX/UI</h4>
                                <p>Creative Labs</p>
                            </div>
                            <span class="status-profile accepted-status">✅ Aceptada</span>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>
</div>