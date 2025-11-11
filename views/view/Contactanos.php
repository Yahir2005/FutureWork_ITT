<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Nosotros</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      min-height: 100%;
    }

    html {
      height: 100%;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      padding: 80px 30px;
      text-align: center;
      color: white;
    }

    .hero-content {
      max-width: 900px;
      margin: 0 auto;
    }

    .hero-title {
      font-size: 48px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero-subtitle {
      font-size: 20px;
      line-height: 1.6;
      opacity: 0.95;
    }

    /* Contenido Principal */
    .main-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 50px 30px;
    }

    /* Sección de Historia */
    .historia-section {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 40px;
    }

    .section-title {
      color: #1e3c72;
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .section-icon {
      font-size: 40px;
    }

    .historia-text {
      color: #555;
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 30px;
    }

    /* Timeline */
    .timeline {
      position: relative;
      padding-left: 40px;
      border-left: 3px solid #2a5298;
      margin-top: 30px;
    }

    .timeline-item {
      position: relative;
      margin-bottom: 30px;
      padding-left: 30px;
    }

    .timeline-item:before {
      content: '';
      position: absolute;
      left: -46px;
      top: 5px;
      width: 16px;
      height: 16px;
      background: #2a5298;
      border-radius: 50%;
      border: 3px solid white;
      box-shadow: 0 0 0 3px #2a5298;
    }

    .timeline-year {
      color: #1e3c72;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .timeline-text {
      color: #666;
      font-size: 15px;
      line-height: 1.6;
    }

    /* Grid de Información */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .info-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }

    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .info-card-icon {
      font-size: 48px;
      margin-bottom: 15px;
    }

    .info-card-title {
      color: #1e3c72;
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 12px;
    }

    .info-card-text {
      color: #666;
      font-size: 15px;
      line-height: 1.6;
    }

    .info-card-link {
      color: #2a5298;
      text-decoration: none;
      font-weight: 600;
      display: inline-block;
      margin-top: 10px;
      transition: all 0.3s ease;
    }

    .info-card-link:hover {
      color: #1e3c72;
    }

    /* Misión y Visión */
    .mision-vision-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .mision-card,
    .vision-card {
      background: white;
      border-radius: 15px;
      padding: 35px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .mision-card {
      border-left: 5px solid #2a5298;
    }

    .vision-card {
      border-left: 5px solid #1e3c72;
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 20px;
    }

    .card-icon {
      font-size: 42px;
    }

    .card-title {
      color: #1e3c72;
      font-size: 26px;
      font-weight: 700;
    }

    .card-text {
      color: #555;
      font-size: 15px;
      line-height: 1.8;
    }

    /* Formulario de Comentarios */
    .comentarios-section {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      color: #333;
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 10px;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 14px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 15px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #2a5298;
      background: white;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 150px;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .btn-enviar {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-enviar:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .form-note {
      color: #666;
      font-size: 13px;
      margin-top: 15px;
      text-align: center;
    }

    /* Stats Banner */
    .stats-banner {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      border-radius: 15px;
      padding: 40px;
      margin-bottom: 40px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 30px;
      text-align: center;
    }

    .stat-item {
      color: white;
    }

    .stat-number {
      font-size: 48px;
      font-weight: 700;
      display: block;
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 16px;
      opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 36px;
      }

      .hero-subtitle {
        font-size: 18px;
      }

      .main-content {
        padding: 30px 20px;
      }

      .section-title {
        font-size: 26px;
      }

      .mision-vision-grid {
        grid-template-columns: 1fr;
      }

      .form-row {
        grid-template-columns: 1fr;
      }

      .stats-banner {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .timeline {
        padding-left: 30px;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Hero Section -->
  <section class="hero-section">
   <div class="hero-content">
    <h1 class="hero-title">🎓 Instituto Tecnológico de Tehuacán</h1>
    <p class="hero-subtitle">Formando profesionales de excelencia desde 1975. Comprometidos con la educación de calidad y el desarrollo tecnológico de la región.</p>
   </div>
  </section><!-- Contenido Principal -->
  <main class="main-content"><!-- Stats Banner -->
   <div class="stats-banner">
    <div class="stat-item"><span class="stat-number">49</span> <span class="stat-label">Años de Historia</span>
    </div>
    <div class="stat-item"><span class="stat-number">81.9%</span> <span class="stat-label">Tasa de Admisión</span>
    </div>
    <div class="stat-item"><span class="stat-number">6</span> <span class="stat-label">Carreras Profesionales</span>
    </div>
    <div class="stat-item"><span class="stat-number">1000+</span> <span class="stat-label">Egresados Anuales</span>
    </div>
   </div><!-- Información Institucional -->
   <div class="info-grid">
    <div class="info-card">
     <div class="info-card-icon">
      📍
     </div>
     <h3 class="info-card-title">Dirección</h3>
     <p class="info-card-text">Libramiento Tecnológico S/N-A.P. 247, Santa María Coapan, Sta María Coapan, 75770 Tehuacán, Pue.</p><a href="https://maps.google.com" target="_blank" rel="noopener noreferrer" class="info-card-link">Ver en mapa →</a>
    </div>
    <div class="info-card">
     <div class="info-card-icon">
      📅
     </div>
     <h3 class="info-card-title">Fundación</h3>
     <p class="info-card-text">1 de octubre de 1975</p>
    </div>
    <div class="info-card">
     <div class="info-card-icon">
      🏛️
     </div>
     <h3 class="info-card-title">Tipo de Institución</h3>
     <p class="info-card-text">Universidad Pública</p>
    </div>
    <div class="info-card">
     <div class="info-card-icon">
      📞
     </div>
     <h3 class="info-card-title">Contacto</h3>
     <p class="info-card-text">Teléfono: 238 380 3370</p><a href="tel:2383803370" class="info-card-link">Llamar ahora →</a>
    </div>
   </div><!-- Historia -->
   <section class="historia-section">
    <h2 class="section-title"><span class="section-icon">📖</span> Nuestra Historia</h2>
    <p class="historia-text">El Instituto Tecnológico de Tehuacán es una institución de educación superior pública que ha sido pilar fundamental en la formación de profesionales en el sureste de Puebla. Desde su fundación en 1975, ha mantenido un compromiso inquebrantable con la excelencia académica y el desarrollo tecnológico de la región.</p>
    <p class="historia-text">Con una tasa de admisión del 81.9%, el ITT se posiciona como una institución accesible que busca brindar oportunidades educativas de calidad a los jóvenes de la región. A lo largo de casi cinco décadas, ha formado a miles de ingenieros y profesionales que contribuyen al desarrollo industrial, tecnológico y social de México.</p>
    <div class="timeline">
     <div class="timeline-item">
      <div class="timeline-year">
       1975
      </div>
      <p class="timeline-text">Fundación del Instituto Tecnológico de Tehuacán, iniciando operaciones con las primeras carreras de ingeniería.</p>
     </div>
     <div class="timeline-item">
      <div class="timeline-year">
       1990
      </div>
      <p class="timeline-text">Expansión de la oferta educativa con nuevas ingenierías especializadas en respuesta a las necesidades industriales de la región.</p>
     </div>
     <div class="timeline-item">
      <div class="timeline-year">
       2000
      </div>
      <p class="timeline-text">Modernización de instalaciones y laboratorios, consolidando al ITT como referente tecnológico en el sureste poblano.</p>
     </div>
     <div class="timeline-item">
      <div class="timeline-year">
       2014
      </div>
      <p class="timeline-text">Alcanza una tasa de admisión del 81.9%, reflejando su compromiso con la educación accesible y de calidad.</p>
     </div>
     <div class="timeline-item">
      <div class="timeline-year">
       2024
      </div>
      <p class="timeline-text">Lanzamiento de FutureWork ITT, plataforma digital para conectar egresados con oportunidades laborales.</p>
     </div>
    </div>
   </section><!-- Misión y Visión -->
   <div class="mision-vision-grid">
    <div class="mision-card">
     <div class="card-header"><span class="card-icon">🎯</span>
      <h2 class="card-title">Misión</h2>
     </div>
     <p class="card-text">Formar profesionales competentes en ingeniería y tecnología, con valores éticos y compromiso social, capaces de contribuir al desarrollo sustentable de la región y del país, mediante programas educativos de calidad, investigación aplicada y vinculación con los sectores productivo y social.</p>
    </div>
    <div class="vision-card">
     <div class="card-header"><span class="card-icon">🔭</span>
      <h2 class="card-title">Visión</h2>
     </div>
     <p class="card-text">Ser una institución de educación superior reconocida a nivel nacional e internacional por la calidad de sus programas educativos, su contribución a la innovación tecnológica y su impacto en el desarrollo económico y social de la región, formando profesionales altamente competitivos y comprometidos con la excelencia.</p>
    </div>
   </div><!-- Formulario de Comentarios -->
   <section class="comentarios-section">
    <h2 class="section-title"><span class="section-icon">💬</span> Déjanos tus Comentarios</h2>
    <p class="historia-text">Tu opinión es importante para nosotros. Comparte tus comentarios, sugerencias o experiencias sobre FutureWork ITT y el Instituto Tecnológico de Tehuacán.</p>
    <form method="POST" action="">
     <div class="form-row">
      <div class="form-group"><label for="nombre">Nombre Completo *</label> <input type="text" id="nombre" name="nombre" required minlength="3" placeholder="Tu nombre completo">
      </div>
      <div class="form-group"><label for="email">Correo Electrónico *</label> <input type="email" id="email" name="email" required placeholder="tu@email.com">
      </div>
     </div>
     <div class="form-group"><label for="asunto">Asunto *</label> <input type="text" id="asunto" name="asunto" required minlength="5" placeholder="Asunto de tu comentario">
     </div>
     <div class="form-group"><label for="comentario">Comentario *</label> <textarea id="comentario" name="comentario" required minlength="20" placeholder="Escribe tu comentario aquí..."></textarea>
     </div><button type="submit" class="btn-enviar">📧 Enviar Comentario</button>
     <p class="form-note">* Campos obligatorios. Tu comentario será enviado al equipo de FutureWork ITT.</p>
    </form>
   </section>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99cb52d01347ae76',t:'MTc2MjgzODI0OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>