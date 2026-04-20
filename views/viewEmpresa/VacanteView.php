<?php
$idMateria = $_GET['idVacante'];

?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Detalles de Vacante</title>
    <link rel="stylesheet" href="css/VacanteView.css" type="text/css"> 
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-text">
     <h1>💼 Detalles de la Vacante</h1>
     <p>Conoce toda la información sobre esta oportunidad laboral</p>
    </div><a href="buscar-vacantes.html" class="btn-back">← Volver a Vacantes</a>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Content Grid -->
   <div class="content-grid"><!-- Main Content -->
    <div><!-- Vacancy Details -->
     <div class="card">
      <div class="card-header">
       <h1 class="card-title"><!-- titulo de Vacantes --></h1><a href="perfil-empresa.html?id=<!-- Empresa_idEmpresa -->" class="company-link"> 🏢 <!-- Nombre de Empresa desde Empresas --> </a> <!-- Estado de la Vacante -->
       <div><span class="status-badge abierta">✓ <!-- estadoValidacionVacante --></span> <!-- Agregar clases: abierta, cerrada, pausada según EstadoValidacionVacante -->
       </div>
      </div><!-- Details Grid -->
      <div class="details-grid">
       <div class="detail-item"><span class="detail-label">📍 Ubicación</span> <span class="detail-value"><!-- ubicacion --></span>
       </div>
       <div class="detail-item"><span class="detail-label">💰 Salario</span> <span class="detail-value">$<!-- salario --> MXN</span>
       </div>
       <div class="detail-item"><span class="detail-label">📋 Tipo de Contrato</span> <span class="detail-value"><!-- estadoContrato de TipoContrato --></span>
       </div>
       <div class="detail-item"><span class="detail-label">💼 Modalidad</span> <span class="detail-value"><!-- tipoModalidad de TipoModalidad --></span>
       </div>
       <div class="detail-item"><span class="detail-label">📅 Publicada</span> <span class="detail-value"><!-- fechaPublicacion --></span>
       </div>
       <div class="detail-item"><span class="detail-label">⏰ Fecha Límite</span> <span class="detail-value"><!-- fechaLimite --></span>
       </div>
      </div><!-- Description Section -->
      <div class="section">
       <h2 class="section-title">📝 Descripción del Puesto</h2>
       <div class="section-content">
        <p><!-- descripcion de Vacantes --></p>
       </div>
      </div><!-- Requirements Section -->
      <div class="section">
       <h2 class="section-title">✅ Requisitos</h2>
       <ul class="requirements-list"><!-- Parsear requisitos de Vacantes y mostrar cada uno -->
        <li>Requisito 1</li>
        <li>Requisito 2</li>
        <li>Requisito 3</li>
        <li>Requisito 4</li>
       </ul>
      </div><!-- Action Buttons -->
      <form id="applicationForm" action="procesar-postulacion.php" method="POST"><!-- Hidden field for Vacante ID --> <input type="hidden" name="Vacantes_idVacante" value="<!-- idVacante desde URL -->"> <!-- Hidden field for Postulante ID (from session) --> <input type="hidden" name="Postulantes_idPostulante" value="<!-- idPostulante desde sesión -->"> <!-- Hidden field for Estado de Postulación --> <input type="hidden" name="estadoPostulacion" value="En Revisión">
       <div class="action-buttons"><button type="submit" class="btn-apply"> ✉️ Postularme Ahora </button> <button type="button" class="btn-share" onclick="compartirVacante()"> 🔗 Compartir Vacante </button>
       </div>
      </form>
     </div>
    </div><!-- Sidebar -->
    <aside><!-- Stats Box -->
     <div class="stats-box">
      <h3>📊 Estadísticas</h3>
      <div class="stat-value">
       <!-- Número -->
      </div>
      <div class="stat-label">
       Postulaciones Recibidas
      </div>
     </div><!-- Vacancy Info -->
     <div class="info-box">
      <h3>📋 Información de la Vacante</h3>
      <div class="info-box-content">
       <div class="info-box-item"><strong>ID de Vacante</strong> <span><!-- idVacante --></span>
       </div>
       <div class="info-box-item"><strong>Publicada</strong> <span><!-- fechaPublicacion formato: DD/MM/YYYY --></span>
       </div>
       <div class="info-box-item"><strong>Fecha Límite</strong> <span><!-- fechaLimite formato: DD/MM/YYYY --></span>
       </div>
       <div class="info-box-item"><strong>Estado</strong> <span><!-- estadoValidacionVacante --></span>
       </div>
      </div>
     </div><!-- Company Info -->
     <div class="info-box">
      <h3>🏢 Sobre la Empresa</h3>
      <div class="info-box-content">
       <div class="info-box-item"><strong>Nombre</strong> <span><!-- Nombre de Empresa --></span>
       </div>
       <div class="info-box-item"><strong>Sector</strong> <span><!-- Sector de la empresa --></span>
       </div>
       <div class="info-box-item"><strong>Ubicación</strong> <span><!-- Ubicación de la empresa --></span>
       </div>
      </div><a href="perfil-empresa.html?id=<!-- Empresa_idEmpresa -->" style="display: block; margin-top: 15px; color: #2a5298; font-weight: 600; text-decoration: none;"> Ver perfil completo → </a>
     </div><!-- Alert Box -->
     <div class="alert-box">
      <h4>⚠️ Importante</h4>
      <p>Asegúrate de cumplir con todos los requisitos antes de postularte. Lee detenidamente la descripción y prepara tu CV actualizado.</p>
     </div><!-- Tips Box -->
     <div class="info-box">
      <h3>💡 Consejos</h3>
      <div class="info-box-content">
       <ul style="list-style: none; padding: 0;">
        <li style="padding: 8px 0; padding-left: 25px; position: relative;"><span style="position: absolute; left: 0; color: #28a745; font-weight: 700;">✓</span> Personaliza tu carta de presentación</li>
        <li style="padding: 8px 0; padding-left: 25px; position: relative;"><span style="position: absolute; left: 0; color: #28a745; font-weight: 700;">✓</span> Actualiza tu CV con información relevante</li>
        <li style="padding: 8px 0; padding-left: 25px; position: relative;"><span style="position: absolute; left: 0; color: #28a745; font-weight: 700;">✓</span> Destaca tus habilidades clave</li>
        <li style="padding: 8px 0; padding-left: 25px; position: relative;"><span style="position: absolute; left: 0; color: #28a745; font-weight: 700;">✓</span> Revisa que cumplas con los requisitos</li>
       </ul>
      </div>
     </div>
    </aside>
   </div>
  </main>
  <script>
    // Form submission
    document.getElementById('applicationForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // In production, submit the form to PHP
      // this.submit();
      
      // For demo, show confirmation
      const btn = this.querySelector('.btn-apply');
      btn.disabled = true;
      btn.textContent = '✅ Postulación Enviada';
      btn.style.background = '#6c757d';
    });

    function compartirVacante() {
      const titulo = document.querySelector('.card-title').textContent;
      const url = window.location.href;
      
      if (navigator.share) {
        navigator.share({
          title: titulo,
          text: 'Mira esta oportunidad laboral en FutureWork ITT',
          url: url
        }).catch(err => console.log('Error al compartir:', err));
      } else {
        // Fallback: copiar al portapapeles
        navigator.clipboard.writeText(url).then(() => {
          const btn = event.target;
          const originalText = btn.textContent;
          btn.textContent = '✅ Link Copiado';
          setTimeout(() => {
            btn.textContent = originalText;
          }, 2000);
        }).catch(err => {
          console.log('Error al copiar:', err);
        });
      }
    }
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bca4371867685db',t:'MTc2ODE5NTg0My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>