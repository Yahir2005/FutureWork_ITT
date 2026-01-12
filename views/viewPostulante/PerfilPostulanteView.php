<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/../../usecase/Postulante/PostulantesController.php";
require_once __DIR__ . "/../../usecase/Carrera/CarreraController.php";
require_once __DIR__ . "/../../Dto/Postulantes.php";




/* Variables */
$datosUsuario = [];
$datosPostulante = [];
$nombreCarrera = "No asignada";

/* Controladores */
$usuarioController = new UsuarioController();

$carreraController = new CarreraController();

/* ID de sesión */
$idUsuario = $_SESSION["idUsuarios"] ?? null;

if ($idUsuario) {

    // 1. Usuario
    $resultUsuario = $usuarioController->obtenerUsuarioPorId($idUsuario);
    if ($resultUsuario && strtolower($resultUsuario->status) === "ok") {
        $datosUsuario = (array) $resultUsuario->body;
    }

    // 2. Postulante
    $resultPostulante = $postulanteController->obtenerPostulantePorUsuario($idUsuario);
    if ($resultPostulante && strtolower($resultPostulante->status) === "ok") {
        $datosPostulante = (array) $resultPostulante->body;

        // 3. Carrera
        if (!empty($datosPostulante['Carrera_idCarrera'])) {
            // 👇 ESTE era el error (nombre del método)
            $resultCarrera = $carreraController->listarCarreraPorId(
                $datosPostulante['Carrera_idCarrera']
            );

            if ($resultCarrera && strtolower($resultCarrera->status) === "ok") {
                $nombreCarrera = $resultCarrera->body['nombreCarrera'] ?? "No asignada";
            }
        }
    }
}
?>



<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Perfil de Postulante</title>
  <link rel="stylesheet" href="css/PerfilPostulanteView.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-top">
     <div class="header-text">
      <h1>👤 Mi Perfil</h1>
      <p>Información personal y profesional</p>
     </div><a href="editar-perfil-postulante.html" class="btn-edit-profile">✏️ Editar Perfil</a>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Alert Messages --> <!-- 
    <div class="alert alert-success">
      ✓ Tu perfil ha sido actualizado exitosamente
    </div>
    <div class="alert alert-info">
      ℹ Completa tu perfil al 100% para aumentar tus oportunidades
    </div>
    --> <!-- Profile Grid -->
   <div class="profile-grid"><!-- Profile Card (Sidebar) -->
    <aside class="profile-card"><!-- Imagen de Perfil -->
     <div class="profile-image-container"><!-- Si hay imagen: --> <!-- <img src="URL_DE_LA_IMAGEN" alt="Foto de perfil" class="profile-image"> --> <!-- Si NO hay imagen (placeholder): -->
      <div class="profile-image-placeholder">
       👤
      </div>
     </div><!-- Nombre Completo (nombreCompleto de Usuarios) -->
     <h2 class="user-name"><!-- nombreCompleto --></h2><!-- Carrera (nombreCarrera de Carrera) -->
     <p class="user-career"><!-- nombreCarrera --></p><!-- Estado --> <span class="user-status"> ✓ Perfil Activo </span> <!-- Estadísticas -->
     <div class="profile-stats">
      <div class="stat-item">
       <div class="stat-value">
        <!-- Número -->
       </div>
       <div class="stat-label">
        Postulaciones
       </div>
      </div>
      <div class="stat-item">
       <div class="stat-value">
        <!-- Número -->
       </div>
       <div class="stat-label">
        En Proceso
       </div>
      </div>
     </div><!-- Acciones -->
     <div class="profile-actions"><a href="buscar-vacantes.html" class="btn-action btn-primary">🔍 Buscar Vacantes</a> <a href="mis-postulaciones.html" class="btn-action btn-secondary">📋 Mis Postulaciones</a> <a href="<!-- cvPath -->" class="btn-action btn-success" download>📄 Descargar CV</a>
     </div>
    </aside><!-- Info Section (Main Content) -->
    <div class="info-section"><!-- Información Personal -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">📋 Información Personal</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="info-grid"><!-- Nombre Completo -->
       <div class="info-item"><span class="info-label">Nombre Completo</span> <span class="info-value"><!-- nombreCompleto --></span>
       </div><!-- Email -->
       <div class="info-item"><span class="info-label">Correo Electrónico</span> <span class="info-value"> <a href="mailto:<!-- email -->">📧 <!-- email --></a> </span>
       </div><!-- Tel��fono -->
       <div class="info-item"><span class="info-label">Teléfono</span> <span class="info-value">📞 <!-- telefono --></span>
       </div><!-- Fecha de Nacimiento -->
       <div class="info-item"><span class="info-label">Fecha de Nacimiento</span> <span class="info-value">🎂 <!-- fechaNacimiento --></span>
       </div><!-- Dirección -->
       <div class="info-item"><span class="info-label">Dirección</span> <span class="info-value">📍 <!-- direccion --></span>
       </div><!-- Fecha de Registro -->
       <div class="info-item"><span class="info-label">Miembro Desde</span> <span class="info-value">📅 <!-- fechaRegistro --></span>
       </div>
      </div>
     </div><!-- Información Académica -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">🎓 Información Académica</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="info-grid"><!-- Carrera (nombreCarrera de Carrera) -->
       <div class="info-item"><span class="info-label">Carrera</span> <span class="info-value"><!-- nombreCarrera --></span>
       </div><!-- ID de Carrera (Carrera_idCarrera) -->
       <div class="info-item"><span class="info-label">ID de Carrera</span> <span class="info-value">🆔 #<!-- Carrera_idCarrera --></span>
       </div><!-- Número de Control (numeroControl de Postulante) -->
       <div class="info-item"><span class="info-label">Número de Control</span> <span class="info-value">🎓 <!-- numeroControl --></span>
       </div><!-- CV Path (cvPath de Postulante) -->
       <div class="info-item"><span class="info-label">Currículum Vitae</span> <span class="info-value"> <!-- Si hay CV: --> <!-- <a href="<!-- cvPath -->" target="_blank"&gt;📄 Ver CV --&gt; <!-- Si NO hay CV: --> <span style="color: #6c757d;">No disponible</span> </span>
       </div>
      </div>
     </div><!-- Habilidades -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">💡 Habilidades y Competencias</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="skills-container"><!-- Ejemplo de habilidades (se generarían dinámicamente) --> <!--
            <span class="skill-tag">JavaScript</span>
            <span class="skill-tag">React</span>
            <span class="skill-tag">Node.js</span>
            <span class="skill-tag">Python</span>
            <span class="skill-tag">SQL</span>
            <span class="skill-tag">Git</span>
            <span class="skill-tag">Trabajo en Equipo</span>
            <span class="skill-tag">Liderazgo</span>
            <span class="skill-tag">Comunicación</span>
            --> <!-- Empty State -->
       <div class="empty-state" style="width: 100%;">
        <div class="empty-state-icon">
         💡
        </div>
        <p>No has agregado habilidades aún</p><a href="editar-perfil-postulante.html" class="btn-action btn-primary">➕ Agregar Habilidades</a>
       </div>
      </div>
     </div><!-- Experiencia Laboral -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">💼 Experiencia Laboral</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="experience-list"><!-- Ejemplo de experiencia (se generaría dinámicamente) --> <!--
            <div class="experience-item">
              <div class="experience-header">
                <div class="experience-title">
                  <h4>Desarrollador Frontend</h4>
                  <p class="experience-company">Tech Solutions SA de CV</p>
                </div>
                <span class="experience-period">📅 Ene 2023 - Actualidad</span>
              </div>
              <p class="experience-description">
                Desarrollo de interfaces de usuario responsivas utilizando React y TypeScript. 
                Colaboración con equipos multidisciplinarios para implementar nuevas funcionalidades.
              </p>
            </div>
            --> <!-- Empty State -->
       <div class="empty-state">
        <div class="empty-state-icon">
         💼
        </div>
        <p>No has agregado experiencia laboral aún</p><a href="editar-perfil-postulante.html" class="btn-action btn-primary">➕ Agregar Experiencia</a>
       </div>
      </div>
     </div><!-- Idiomas -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">🌐 Idiomas</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="languages-list"><!-- Ejemplo de idiomas (se generarían dinámicamente) --> <!--
            <div class="language-item">
              <div class="language-name">Español</div>
              <div class="language-level">Nativo</div>
            </div>
            <div class="language-item">
              <div class="language-name">Inglés</div>
              <div class="language-level">Avanzado</div>
            </div>
            <div class="language-item">
              <div class="language-name">Francés</div>
              <div class="language-level">Intermedio</div>
            </div>
            --> <!-- Empty State -->
       <div class="empty-state" style="grid-column: 1 / -1;">
        <div class="empty-state-icon">
         🌐
        </div>
        <p>No has agregado idiomas aún</p><a href="editar-perfil-postulante.html" class="btn-action btn-primary">➕ Agregar Idiomas</a>
       </div>
      </div>
     </div><!-- Certificaciones -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">🏆 Certificaciones</h3><a href="editar-perfil-postulante.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="certifications-list"><!-- Ejemplo de certificaciones (se generarían dinámicamente) --> <!--
            <div class="certification-item">
              <div class="certification-info">
                <h4>AWS Certified Solutions Architect</h4>
                <p>Amazon Web Services</p>
              </div>
              <span class="certification-date">📅 Dic 2023</span>
            </div>
            <div class="certification-item">
              <div class="certification-info">
                <h4>Professional Scrum Master I</h4>
                <p>Scrum.org</p>
              </div>
              <span class="certification-date">📅 Jun 2023</span>
            </div>
            --> <!-- Empty State -->
       <div class="empty-state">
        <div class="empty-state-icon">
         🏆
        </div>
        <p>No has agregado certificaciones aún</p><a href="editar-perfil-postulante.html" class="btn-action btn-primary">➕ Agregar Certificaciones</a>
       </div>
      </div>
     </div><!-- Postulaciones Recientes -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">📨 Postulaciones Recientes</h3><a href="mis-postulaciones.html" class="btn-edit-section">Ver Todas</a>
      </div>
      <div class="applications-list"><!-- Ejemplo de postulaciones (se generarían dinámicamente) --> <!--
            <div class="application-item">
              <div class="application-header">
                <div class="application-title">
                  <h4>Desarrollador Full Stack</h4>
                  <p class="application-company">Tech Innovations SA</p>
                </div>
                <span class="application-status status-reviewing">🔍 En Revisión</span>
              </div>
              <div class="application-details">
                <span>📅 Postulado: 15/01/2024</span>
                <span>📍 Tijuana, BC</span>
                <span>💰 $25,000 - $35,000</span>
              </div>
            </div>
            --> <!-- Empty State -->
       <div class="empty-state">
        <div class="empty-state-icon">
         📭
        </div>
        <p>No has realizado postulaciones aún</p><a href="buscar-vacantes.html" class="btn-action btn-primary">🔍 Buscar Vacantes</a>
       </div>
      </div>
     </div>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a1d7d8850196dba',t:'MTc2MzY5OTgzMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>