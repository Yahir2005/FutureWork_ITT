<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Mis Vacantes</title>
   <link rel="stylesheet" href="css/MisVacantesListView.css">
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
      <h1>💼 Mis Vacantes Publicadas</h1>
      <p>Administra las ofertas laborales de tu empresa</p>
     </div><a href="agregar-vacante.html" class="btn-add">➕ Publicar Nueva Vacante</a>
    </div><!-- Stats Cards -->
    <div class="stats-container">
     <div class="stat-card">
      <div class="stat-label">
       📊 Total de Vacantes
      </div>
      <div class="stat-value">
       <!-- Total -->
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ✅ Aprobadas
      </div>
      <div class="stat-value">
       <!-- Aprobadas -->
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ⏳ Pendientes
      </div>
      <div class="stat-value">
       <!-- Pendientes -->
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ❌ Rechazadas
      </div>
      <div class="stat-value">
       <!-- Rechazadas -->
      </div>
     </div>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Mensajes de alerta (se mostrarán según sea necesario) --> <!-- 
    <div class="alert alert-success">
      ✓ Vacante publicada exitosamente y enviada a revisión
    </div>
    <div class="alert alert-error">
      ✗ Error al procesar la solicitud
    </div>
    <div class="alert alert-info">
      ℹ Tu vacante está en revisión. Te notificaremos cuando sea aprobada
    </div>
    --> <!-- Filter Section -->
   <div class="filter-section">
    <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
    <form method="GET" action="" class="filter-form">
     <div class="filter-group"><label for="titulo">Título de Vacante</label> <input type="text" id="titulo" name="titulo" placeholder="Buscar por título...">
     </div>
     <div class="filter-group"><label for="estado_validacion">Estado de Validación</label> <select id="estado_validacion" name="estado_validacion"> <option value="">Todos los estados</option> <option value="1">Aprobada</option> <option value="2">Pendiente</option> <option value="3">Rechazada</option> </select>
     </div>
     <div class="filter-group"><label for="tipo_contrato">Tipo de Contrato</label> <select id="tipo_contrato" name="tipo_contrato"> <option value="">Todos los tipos</option> <option value="1">Tiempo Completo</option> <option value="2">Medio Tiempo</option> <option value="3">Por Proyecto</option> <option value="4">Pasantía</option> </select>
     </div>
     <div class="filter-group"><label for="modalidad">Modalidad</label> <select id="modalidad" name="modalidad"> <option value="">Todas las modalidades</option> <option value="1">Presencial</option> <option value="2">Remoto</option> <option value="3">Híbrido</option> </select>
     </div>
     <div class="filter-actions"><button type="submit" class="btn-filter">🔍 Buscar</button> <a href="?" class="btn-clear">✖ Limpiar Filtros</a>
     </div>
    </form>
   </div><!-- Results Header -->
   <div class="results-header">
    <div class="results-count">
     Mostrando: <span><!-- Cantidad --></span> vacantes
    </div>
    <form method="GET" action="" class="sort-form"><label for="ordenar">Ordenar por:</label> <select id="ordenar" name="ordenar"> <option value="fecha_desc">Más recientes</option> <option value="fecha_asc">Más antiguas</option> <option value="titulo_asc">Título A-Z</option> <option value="titulo_desc">Título Z-A</option> <option value="salario_desc">Salario mayor</option> <option value="salario_asc">Salario menor</option> </select>
    </form>
   </div><!-- Vacancies Grid -->
   <div class="vacancies-grid"><!-- Aquí se generarán dinámicamente las tarjetas de vacantes --> <!-- Estructura de ejemplo (comentada para referencia):
      
      <div class="vacancy-card">
        <div class="vacancy-header">
          <div class="vacancy-title">
            <h3>Desarrollador Full Stack</h3>
            <div class="vacancy-id">ID: #12345</div>
          </div>
          <span class="validation-status status-aprobada">
            ✓ Aprobada
          </span>
        </div>

        <div class="vacancy-details">
          <div class="detail-item">
            <span class="detail-label">Ubicación</span>
            <span class="detail-value">📍 Ciudad de México</span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Salario</span>
            <span class="detail-value salary">💰 $25,000.00</span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Tipo Contrato</span>
            <span class="detail-value">📝 Tiempo Completo</span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Modalidad</span>
            <span class="detail-value">💻 Remoto</span>
          </div>
        </div>

        <p class="vacancy-description">
          Buscamos desarrollador full stack con experiencia en React y Node.js...
        </p>

        <div class="vacancy-tags">
          <span class="tag contract">Tiempo Completo</span>
          <span class="tag modality">Remoto</span>
          <span class="tag location">CDMX</span>
        </div>

        <div class="vacancy-footer">
          <div class="dates-info">
            <div class="date-item">
              📅 Publicado: <strong>15/01/2024</strong>
            </div>
            <div class="date-item">
              ⏰ Límite: <strong>28/02/2024</strong>
            </div>
          </div>
          <div class="vacancy-actions">
            <a href="detalle-vacante.html" class="btn-details">👁️ Ver Detalles</a>
            <a href="editar-vacante.html" class="btn-edit">✏️ Editar</a>
            <button class="btn-delete">🗑️ Eliminar</button>
          </div>
        </div>
      </div>
      
      --> <!-- Empty State (mostrar cuando no hay vacantes) -->
    <div class="empty-state">
     <div class="empty-state-icon">
      📭
     </div>
     <h3>Tu empresa no tiene vacantes publicadas</h3>
     <p>Comienza a publicar ofertas laborales de tu empresa y encuentra a los mejores candidatos.</p><a href="agregar-vacante.html" class="btn-add">➕ Publicar Primera Vacante de la Empresa</a>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a158e8da55ab1f2',t:'MTc2MzYxNjY0Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>