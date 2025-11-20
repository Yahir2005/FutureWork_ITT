<?php
      include_once("../FutureWork_ITT/router/Router.php");
    include_once __DIR__ . "/../usecase/Usuario/UsuarioController.php";
    include_once __DIR__ ."/../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: /../index.php");
    }
?>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Inicio Invitado</title>
    <link rel="stylesheet" href="css/navbar.css">
  <style>
    
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
    <section>
          <?php
            $enrutador = new Router();
            if(isset($_GET['cargar']))
            if($enrutador->validarGET($_GET['cargar'])){
              $enrutador->cargarVista($_GET['cargar']);
              }
            ?>
    </section>

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