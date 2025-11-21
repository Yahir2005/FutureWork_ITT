<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Perfil de Empresa</title>
    <link rel="stylesheet" href="css/PerfilEmpresaView.css">
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
      <h1>🏢 Perfil de Empresa</h1>
      <p>Información completa de la empresa</p>
     </div><a href="editar-perfil-empresa.html" class="btn-edit-profile">✏️ Editar Perfil</a>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Alert Messages (mostrar según estado de validación) --> <!-- 
    <div class="alert alert-success">
      ✓ Tu empresa ha sido validada y aprobada exitosamente
    </div>
    <div class="alert alert-warning">
      ⏳ Tu empresa está en proceso de validación. Te notificaremos cuando sea aprobada.
    </div>
    <div class="alert alert-error">
      ✗ Tu empresa ha sido rechazada. Por favor revisa los comentarios del administrador.
    </div>
    --> <!-- Profile Grid -->
   <div class="profile-grid"><!-- Profile Card (Sidebar) -->
    <aside class="profile-card"><!-- Imagen de Perfil (urlImagenPerfilEmpresa) -->
     <div class="profile-image-container"><!-- Si hay imagen: --> <!-- <img src="URL_DE_LA_IMAGEN" alt="Logo de la empresa" class="profile-image"> --> <!-- Si NO hay imagen (placeholder): -->
      <div class="profile-image-placeholder">
       🏢
      </div>
     </div><!-- Nombre de la Empresa (nombreEmpresa) -->
     <h2 class="company-name"><!-- Nombre de la Empresa --></h2><!-- Sector (sector) -->
     <p class="company-sector"><!-- Sector de la Empresa --></p><!-- Estado de Validación (EstadoValidacionEmpresa_idEstadoValidacionEmpresa) --> <!-- 1 = Aprobada, 2 = Pendiente, 3 = Rechazada --> <span class="validation-badge badge-aprobada"> ✓ Empresa Validada </span> <!-- 
        <span class="validation-badge badge-pendiente">
          ⏳ En Validación
        </span>
        <span class="validation-badge badge-rechazada">
          ✗ Rechazada
        </span>
        --> <!-- Estadísticas -->
     <div class="profile-stats">
      <div class="stat-item">
       <div class="stat-value">
        <!-- Número -->
       </div>
       <div class="stat-label">
        Vacantes Activas
       </div>
      </div>
      <div class="stat-item">
       <div class="stat-value">
        <!-- Número -->
       </div>
       <div class="stat-label">
        Postulaciones
       </div>
      </div>
     </div><!-- Acciones -->
     <div class="profile-actions"><a href="mis-vacantes.html" class="btn-action btn-primary">📋 Ver Mis Vacantes</a> <a href="publicar-vacante.html" class="btn-action btn-secondary">➕ Publicar Vacante</a>
     </div>
    </aside><!-- Info Section (Main Content) -->
    <div class="info-section"><!-- Información General -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">📊 Información General</h3><a href="editar-perfil-empresa.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="info-grid"><!-- ID de Empresa (idEmpresas) -->
       <div class="info-item"><span class="info-label">ID de Empresa</span> <span class="info-value">#<!-- idEmpresas --></span>
       </div><!-- Representante (representante) -->
       <div class="info-item"><span class="info-label">Representante Legal</span> <span class="info-value"><!-- representante --></span>
       </div><!-- Sitio Web (sitioWeb) -->
       <div class="info-item"><span class="info-label">Sitio Web</span> <span class="info-value"> <a href="<!-- sitioWeb -->" target="_blank" rel="noopener noreferrer"> 🌐 <!-- sitioWeb --> </a> </span>
       </div><!-- Sector (sector) -->
       <div class="info-item"><span class="info-label">Sector Industrial</span> <span class="info-value"><!-- sector --></span>
       </div><!-- Fecha de Registro (desde tabla Usuarios - fechaRegistro) -->
       <div class="info-item"><span class="info-label">Fecha de Registro</span> <span class="info-value">📅 <!-- fechaRegistro --></span>
       </div><!-- Estado de Validación -->
       <div class="info-item"><span class="info-label">Estado de Validación</span> <span class="info-value"> <!-- Según EstadoValidacionEmpresa_idEstadoValidacionEmpresa --> ✓ Validada </span>
       </div>
      </div>
     </div><!-- Descripción de la Empresa -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">📝 Acerca de la Empresa</h3><a href="editar-perfil-empresa.html" class="btn-edit-section">✏️ Editar</a>
      </div><!-- Descripción (descripcion) -->
      <p class="description-text"><!-- descripcion --> <!-- Ejemplo: --> <!-- Somos una empresa líder en el sector tecnológico con más de 15 años de experiencia en el desarrollo de soluciones innovadoras. Nos especializamos en crear productos de software de alta calidad que transforman la manera en que las empresas operan. Nuestro equipo está compuesto por profesionales altamente capacitados comprometidos con la excelencia y la innovación continua. --></p>
     </div><!-- Información de Contacto (desde tabla Usuarios) -->
     <div class="info-card">
      <div class="info-card-header">
       <h3 class="info-card-title">📧 Información de Contacto</h3><a href="editar-perfil-empresa.html" class="btn-edit-section">✏️ Editar</a>
      </div>
      <div class="info-grid"><!-- Nombre Completo del Usuario (nombreCompleto) -->
       <div class="info-item"><span class="info-label">Nombre de Contacto</span> <span class="info-value"><!-- nombreCompleto --></span>
       </div><!-- Email (email) -->
       <div class="info-item"><span class="info-label">Correo Electrónico</span> <span class="info-value"> <a href="mailto:<!-- email -->">📧 <!-- email --></a> </span>
       </div><!-- ID de Usuario (Usuarios_idUsuarios) -->
       <div class="info-item"><span class="info-label">ID de Usuario</span> <span class="info-value">#<!-- Usuarios_idUsuarios --></span>
       </div><!-- Rol (desde tabla Usuarios - Rol_idRol) -->
       <div class="info-item"><span class="info-label">Tipo de Cuenta</span> <span class="info-value">👤 Empresa</span>
       </div>
      </div>
     </div><!-- Vacantes Recientes -->
     <div class="vacancies-preview">
      <div class="info-card-header">
       <h3 class="info-card-title">💼 Vacantes Recientes</h3><a href="mis-vacantes.html" class="btn-edit-section">Ver Todas</a>
      </div><!-- Lista de Vacantes (se generaría dinámicamente) --> <!-- Ejemplo de vacante: --> <!--
          <div class="vacancy-item">
            <div class="vacancy-header">
              <h4 class="vacancy-title">Desarrollador Full Stack</h4>
              <span class="vacancy-status status-active">✓ Activa</span>
            </div>
            <div class="vacancy-details">
              <span class="vacancy-detail">📍 Tijuana, BC</span>
              <span class="vacancy-detail">💰 $25,000 - $35,000</span>
              <span class="vacancy-detail">📅 Publicada: 15/01/2024</span>
              <span class="vacancy-detail">👥 12 Postulaciones</span>
            </div>
          </div>
          --> <!-- Empty State (cuando no hay vacantes) -->
      <div class="empty-state">
       <div class="empty-state-icon">
        📭
       </div>
       <p>No hay vacantes publicadas aún</p><a href="publicar-vacante.html" class="btn-action btn-primary">➕ Publicar Primera Vacante</a>
      </div>
     </div>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a1d579922246dba',t:'MTc2MzY5ODI3Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>