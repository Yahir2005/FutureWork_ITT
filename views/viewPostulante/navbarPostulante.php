<?php
    include_once("../../router/RouterPostulante.php");
    include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: ../index.php");
    }
?>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Inicio Invitado</title>
    <link rel="stylesheet" href="../css/navbar.css">
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
     <li><a class="nav-link" href="?cargar=Home" >🏠 Inicio</a></li>
     <li><a class="nav-link" href="?cargar=VacantesListView">💼 Vacantes</a></li>
     <li><a class="nav-link" href="?cargar=EmpresasListView">🏢 Empresas</a></li>
     <li><a class="nav-link" href="?cargar=AcercaDeNosotrosView">ℹ️ Nosotros</a></li>
     <li><a class="nav-link" href="?cargar=ContactoView">📧 Contacto</a></li>
    </ul><!-- Acciones -->
    <div class="navbar-actions">
     <div class="user-badge">
      <div class="user-icon">
       👤
      </div><a class="nav-link" href="?cargar=PerfilPostulanteView"><span>Postulante</span></a>
    </div>
   </div>
  </nav>

    <section>
            <?php

                $enrutador = new RouterPostulante();
                if(isset($_GET['cargar']))
                if($enrutador->validarGET($_GET['cargar'])){
                    $enrutador->cargarVista($_GET['cargar']);
                }
            ?>
    </section>
  </main>
</html>