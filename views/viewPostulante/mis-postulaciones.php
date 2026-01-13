<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Postulaciones - FutureWork ITT</title>
    <link rel="stylesheet" href="css/mis-postulaciones.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-title"><span style="font-size: 32px;">📋</span>
     <h1>Mis Postulaciones</h1>
    </div><a href="vacantes.html" class="btn-back">← Volver a Vacantes</a>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Summary Cards -->
   <div class="summary-section">
    <div class="summary-card">
     <div class="summary-icon revision">
      ⏳
     </div>
     <div class="summary-content">
      <h3 id="count-revision">0</h3>
      <p>En Revisión</p>
     </div>
    </div>
    <div class="summary-card">
     <div class="summary-icon aceptada">
      ✅
     </div>
     <div class="summary-content">
      <h3 id="count-aceptada">0</h3>
      <p>Aceptadas</p>
     </div>
    </div>
    <div class="summary-card">
     <div class="summary-icon entrevista">
      📅
     </div>
     <div class="summary-content">
      <h3 id="count-entrevista">0</h3>
      <p>Entrevistas</p>
     </div>
    </div>
    <div class="summary-card">
     <div class="summary-icon rechazada">
      ❌
     </div>
     <div class="summary-content">
      <h3 id="count-rechazada">0</h3>
      <p>Rechazadas</p>
     </div>
    </div>
   </div><!-- Section Title -->
   <h2 class="section-title">📌 Historial de Postulaciones</h2><!-- Loading State -->
   <div id="loading" class="loading-spinner">
    <div class="spinner"></div>
   </div><!-- Postulaciones Grid -->
   <div id="postulaciones-container" class="postulaciones-grid" style="display: none;"><!-- Las postulaciones se cargarán aquí dinámicamente -->
   </div><!-- Empty State -->
   <div id="empty-state" class="empty-state" style="display: none;">
    <div class="empty-state-icon">
     📭
    </div>
    <h3>No tienes postulaciones aún</h3>
    <p>Comienza a postularte a las vacantes que más te interesen</p><a href="vacantes.html" class="btn-buscar-vacantes">Buscar Vacantes</a>
   </div>
  </main>
  <script>
    // Configuración
    const API_URL = 'http://tuservidor.com/api'; // Cambia esto por tu URL
    const ID_POSTULANTE = 1; // Esto debería venir de la sesión del usuario

    // Función para cargar las postulaciones
    async function cargarPostulaciones() {
      try {
        const response = await fetch(`${API_URL}/mis-postulaciones.php?idPostulante=${ID_POSTULANTE}`);
        
        if (!response.ok) {
          throw new Error('Error al cargar las postulaciones');
        }

        const data = await response.json();

        // Ocultar loading
        document.getElementById('loading').style.display = 'none';

        if (data.postulaciones && data.postulaciones.length > 0) {
          mostrarPostulaciones(data.postulaciones);
          actualizarContadores(data.postulaciones);
        } else {
          document.getElementById('empty-state').style.display = 'block';
        }

      } catch (error) {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('empty-state').style.display = 'block';
      }
    }

    // Función para mostrar las postulaciones
    function mostrarPostulaciones(postulaciones) {
      const container = document.getElementById('postulaciones-container');
      container.style.display = 'grid';
      container.innerHTML = '';

      postulaciones.forEach(postulacion => {
        const estadoClass = obtenerClaseEstado(postulacion.estadoPostulacion);
        const estadoEmoji = obtenerEmojiEstado(postulacion.estadoPostulacion);

        const card = `
          <div class="postulacion-card ${estadoClass}">
            <div class="card-header">
              <div class="card-title-section">
                <h3>${postulacion.titulo}</h3>
                <div class="postulacion-id">Postulación #${postulacion.idPostulacion}</div>
              </div>
              <div class="estado-badge ${estadoClass.replace('estado-', '')}">
                <span>${estadoEmoji}</span>
                <span>${postulacion.estadoPostulacion}</span>
              </div>
            </div>

            <div class="card-body">
              <div class="info-row">
                <div class="info-item">
                  🏢 <strong>Empresa:</strong> ${postulacion.nombreEmpresa || 'No especificada'}
                </div>
                <div class="info-item">
                  📍 <strong>Ubicación:</strong> ${postulacion.ubicacion}
                </div>
              </div>

              <div class="info-row">
                <div class="info-item">
                  💰 <strong>Salario:</strong> $${postulacion.salario ? Number(postulacion.salario).toLocaleString() : 'No especificado'}
                </div>
                <div class="info-item">
                  📋 <strong>Contrato:</strong> ${postulacion.tipoContrato || 'No especificado'}
                </div>
                <div class="info-item">
                  💻 <strong>Modalidad:</strong> ${postulacion.tipoModalidad || 'No especificada'}
                </div>
              </div>

              <div class="descripcion-vacante">
                <strong>Descripción:</strong><br>
                ${postulacion.descripcion}
              </div>
            </div>

            <div class="card-footer">
              <div class="fecha-postulacion">
                📅 Postulado el ${formatearFecha(postulacion.fechaPostulacion)}
              </div>
              <a href="detalle-vacante.html?id=${postulacion.idVacante}" class="btn-ver-detalles">
                Ver Detalles
              </a>
            </div>
          </div>
        `;

        container.innerHTML += card;
      });
    }

    // Función para actualizar contadores
    function actualizarContadores(postulaciones) {
      const contadores = {
        'En revisión': 0,
        'Aceptada': 0,
        'Rechazada': 0,
        'Entrevista Programada': 0
      };

      postulaciones.forEach(p => {
        if (contadores.hasOwnProperty(p.estadoPostulacion)) {
          contadores[p.estadoPostulacion]++;
        }
      });

      document.getElementById('count-revision').textContent = contadores['En revisión'];
      document.getElementById('count-aceptada').textContent = contadores['Aceptada'];
      document.getElementById('count-entrevista').textContent = contadores['Entrevista Programada'];
      document.getElementById('count-rechazada').textContent = contadores['Rechazada'];
    }

    // Función auxiliar para obtener la clase CSS según el estado
    function obtenerClaseEstado(estado) {
      const clases = {
        'En revisión': 'estado-revision',
        'Aceptada': 'estado-aceptada',
        'Rechazada': 'estado-rechazada',
        'Entrevista Programada': 'estado-entrevista'
      };
      return clases[estado] || 'estado-revision';
    }

    // Función auxiliar para obtener el emoji según el estado
    function obtenerEmojiEstado(estado) {
      const emojis = {
        'En revisión': '⏳',
        'Aceptada': '✅',
        'Rechazada': '❌',
        'Entrevista Programada': '📅'
      };
      return emojis[estado] || '📋';
    }

    // Función para formatear fechas
    function formatearFecha(fecha) {
      const date = new Date(fecha);
      const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
      return date.toLocaleDateString('es-ES', opciones);
    }

    // Cargar postulaciones al cargar la página
    document.addEventListener('DOMContentLoaded', cargarPostulaciones);
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd3221c8766f863',t:'MTc2ODI4ODg0OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>