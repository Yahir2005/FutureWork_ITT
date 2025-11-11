<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Inicio Invitado</title>
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

    /* Navbar */
    .navbar {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 70px;
    }

    .navbar-logo {
      display: flex;
      align-items: center;
      gap: 15px;
      text-decoration: none;
      color: white;
    }

    .logo-circle {
      width: 45px;
      height: 45px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #1e3c72;
      font-size: 18px;
    }

    .logo-text {
      font-size: 24px;
      font-weight: 700;
    }

    .navbar-menu {
      display: flex;
      list-style: none;
      gap: 5px;
      align-items: center;
    }

    .navbar-menu li a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-menu li a:hover {
      background: rgba(255, 255, 255, 0.15);
    }

    .navbar-menu li a.active {
      background: rgba(255, 255, 255, 0.2);
    }

    .navbar-actions {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .btn-login {
      padding: 10px 24px;
      background: white;
      color: #1e3c72;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }

    .btn-register {
      padding: 10px 24px;
      background: transparent;
      color: white;
      border: 2px solid white;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-register:hover {
      background: white;
      color: #1e3c72;
    }

    .user-badge {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 16px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 25px;
      color: white;
      font-size: 14px;
    }

    .user-icon {
      width: 32px;
      height: 32px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #1e3c72;
      font-size: 16px;
    }

    /* Contenido Principal */
    .main-content {
      max-width: 1400px;
      margin: 40px auto;
      padding: 0 30px;
    }

    .welcome-section {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .welcome-section h1 {
      color: #1e3c72;
      font-size: 32px;
      margin-bottom: 15px;
    }

    .welcome-section p {
      color: #666;
      font-size: 16px;
      line-height: 1.6;
    }

    .info-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin-top: 30px;
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
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .info-card h3 {
      color: #1e3c72;
      font-size: 20px;
      margin-bottom: 12px;
    }

    .info-card p {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .navbar-container {
        padding: 0 20px;
      }

      .navbar-menu {
        display: none;
      }

      .logo-text {
        font-size: 18px;
      }

      .navbar-actions {
        gap: 8px;
      }

      .btn-login, .btn-register {
        padding: 8px 16px;
        font-size: 13px;
      }

      .main-content {
        padding: 0 20px;
      }

      .welcome-section {
        padding: 25px;
      }

      .welcome-section h1 {
        font-size: 24px;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Navbar -->
  <nav class="navbar">
   <div class="navbar-container"><!-- Logo --> <a href="index.php" class="navbar-logo">
     <div class="logo-circle">
      FW
     </div><span class="logo-text">FutureWork ITT</span> </a> <!-- Menú de Navegación -->
    <ul class="navbar-menu">
     <li><a href="index.php" class="active">🏠 Inicio</a></li>
     <li><a href="vacantes.php">💼 Vacantes</a></li>
     <li><a href="empresas.php">🏢 Empresas</a></li>
     <li><a href="nosotros.php">ℹ️ Nosotros</a></li>
     <li><a href="contacto.php">📧 Contacto</a></li>
    </ul><!-- Acciones -->
    <div class="navbar-actions">
     <div class="user-badge">
      <div class="user-icon">
       👤
      </div><span>Invitado</span>
     </div><a href="login.php" class="btn-login">Iniciar Sesión</a> <a href="registro.php" class="btn-register">Registrarse</a>
    </div>
   </div>
  </nav><!-- Contenido Principal -->
  <main class="main-content">
   <section class="welcome-section">
    <h1>¡Bienvenido a FutureWork ITT! 👋</h1>
    <p>Estás navegando como invitado. Explora las oportunidades laborales disponibles y conoce las empresas que buscan talento del Instituto Tecnológico de Tehuacán. Para acceder a todas las funcionalidades, inicia sesión o regístrate.</p>
   </section>
   <div class="info-cards">
    <div class="info-card">
     <div class="info-card-icon">
      💼
     </div>
     <h3>Explora Vacantes</h3>
     <p>Descubre las oportunidades laborales publicadas por empresas que buscan egresados del ITT. Filtra por carrera, ubicación y tipo de empleo.</p>
    </div>
    <div class="info-card">
     <div class="info-card-icon">
      🏢
     </div>
     <h3>Conoce Empresas</h3>
     <p>Explora el directorio de empresas asociadas y conoce más sobre sus valores, cultura organizacional y oportunidades de crecimiento.</p>
    </div>
    <div class="info-card">
     <div class="info-card-icon">
      🎓
     </div>
     <h3>Regístrate Ahora</h3>
     <p>Crea tu cuenta para postularte a vacantes, recibir notificaciones personalizadas y conectar directamente con reclutadores.</p>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99cb2b7fe078ae76',t:'MTc2MjgzNjYzOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>