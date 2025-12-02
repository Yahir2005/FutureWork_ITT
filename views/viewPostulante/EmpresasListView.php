<?php

?>

<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Listado de Empresas</title>
    <link rel="stylesheet" href="css/EmpresasListView.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-text">
     <h1>🏢 Gestión de Empresas</h1>
     <p>Administra las empresas registradas en la plataforma</p>
    </div>
    <div class="header-actions"><a href="agregar-empresa.php" class="btn-add">➕ Registrar Nueva Empresa</a>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Aquí irán los mensajes de éxito o error desde PHP --> <!-- 
    <div class="alert alert-success">
      ✓ Empresa eliminada exitosamente
    </div>
    <div class="alert alert-error">
      ✗ Error al procesar la solicitud
    </div>
    <div class="alert alert-info">
      ℹ No se encontraron empresas con los filtros aplicados
    </div>
    --> <!-- Filter Section -->
   <div class="filter-section">
    <h3 class="filter-title">🔍 Filtros de Búsqueda</h3>
    <form method="GET" action="" class="filter-form">
     <div class="filter-group"><label for="nombre">Nombre de Empresa</label> <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre...">
     </div>
     <div class="filter-group"><label for="sector">Sector</label> <input type="text" id="sector" name="sector" placeholder="Ej: Tecnología, Salud...">
     </div>
     <div class="filter-group"><label for="validacion">Estado de Validación</label> <select id="validacion" name="validacion"> <option value="">Todos los estados</option> <option value="1">Validada</option> <option value="2">Pendiente</option> <option value="3">Rechazada</option> </select>
     </div>
     <div class="filter-actions"><button type="submit" class="btn-filter">🔍 Buscar</button> <a href="?" class="btn-clear">✖ Limpiar</a>
     </div>
    </form>
   </div><!-- Results Header -->
   <div class="results-header">
    <div class="results-count">
     Total de empresas: <span>0</span> <!-- Aquí PHP mostrará el conteo real -->
    </div>
    <form method="GET" action="" class="sort-form"><label for="ordenar">Ordenar por:</label> <select id="ordenar" name="ordenar" onchange="this.form.submit()"> <option value="nombre_asc">Nombre A-Z</option> <option value="nombre_desc">Nombre Z-A</option> <option value="fecha_desc">Más recientes</option> <option value="fecha_asc">Más antiguas</option> <option value="vacantes_desc">Más vacantes</option> <option value="vacantes_asc">Menos vacantes</option> </select>
    </form>
   </div><!-- Companies Grid -->
   <div class="companies-grid"><!-- Aquí PHP generará las tarjetas de empresas dinámicamente --> <!-- Ejemplo de estructura de una tarjeta (comentado para referencia):
      
      <div class="company-card">
        <div class="company-header">
          <div class="company-icon">🏢</div>
          <div class="company-title">
            <h3>Nombre de la Empresa</h3>
            <div class="company-sector">Sector Tecnología</div>
          </div>
          <span class="validation-status status-validada">✓ Validada</span>
        </div>

        <p class="company-description">
          Descripción de la empresa...
        </p>

        <div class="company-stats">
          <div class="stat-item">
            <span class="stat-label">Vacantes</span>
            <span class="stat-value">12</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Abiertas</span>
            <span class="stat-value">8</span>
          </div>
        </div>

        <div class="company-footer">
          <div class="registration-date">
            📅 Registrada: 15/01/2024
          </div>
          <div class="company-actions">
            <a href="perfil-empresa.php?id=1" class="btn-profile">👁️ Ver Perfil</a>
            <a href="vacantes-empresa.php?idEmpresa=1" class="btn-vacancies">💼 Ver Vacantes</a>
            <a href="editar-empresa.php?id=1" class="btn-edit">✏️ Editar</a>
            <form method="POST" action="eliminar-empresa.php" style="display:inline;">
              <input type="hidden" name="id" value="1">
              <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">🗑️ Eliminar</button>
            </form>
          </div>
        </div>
      </div>
      
      --> <!-- Empty State (mostrar cuando no hay empresas) -->
    <div class="empty-state">
     <div class="empty-state-icon">
      🏢
     </div>
     <h3>No se encontraron empresas</h3>
     <p>No hay empresas registradas en el sistema o no coinciden con los filtros aplicados.</p><a href="agregar-empresa.php" class="btn-add">➕ Registrar Primera Empresa</a>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a155cd3b54db1f2',t:'MTc2MzYxNDYwNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>