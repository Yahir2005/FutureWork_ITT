<?php
  include_once("../../router/RouterEmpresa.php");
  include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";
  require_once __DIR__ ."/../../usecase/Usuario/UsuarioController.php";
  /*
  $controller = new UsuarioController();

    session_start(); // siempre al inicio del script
    $idUsuario = $_SESSION["idUsuarios"];
    $result = $controller->obtenerEntidadPorUsuario($idUsuario);
    if ($result->status == "ok"){
      $datos = $result->body;
      $idEmpresa = $datos['empresaId'];
      echo "El usuario es una Empresa con ID: " . $idEmpresa;
    }*/

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
   <div class="navbar-container"><!-- Logo --> <a href="?cargar=Home" class="navbar-logo">
     <div class="logo-circle">
      FW
     </div><span class="logo-text">FutureWork ITT</span> </a> <!-- Menú de Navegación -->
    <ul class="navbar-menu">
    
     <li><a class="nav-link" href="?cargar=Home">🏠 Inicio</a></li>
     
    <li class="relative group">
      <a class="nav-link dropdown-toggle flex items-center cursor-pointer" 
        id="vacantesDropdownToggle">
          💼 Vacantes 
          <span class="ml-1 text-xs">&#9660;</span> 
      </a>

      <ul class="absolute hidden group-hover:block w-48 bg-gray-700 shadow-lg rounded-md z-10 transition duration-300 ease-in-out py-1 mt-1 left-0" 
          id="vacantesDropdownMenu">
          
          <li><a class="block px-4 py-2 text-sm text-white hover:bg-gray-600" 
                href="?cargar=VacantesAddView">Publicar Vacantes</a></li>

          <hr class="border-gray-600 my-1">
                
          <li><a class="block px-4 py-2 text-sm text-white hover:bg-gray-600" 
                href="?cargar=VacantesListView">Ver Vacantes Empresas</a></li>
                
          <hr class="border-gray-600 my-1">
                
          <li><a class="block px-4 py-2 text-sm text-white hover:bg-gray-600" 
                href="?cargar=MisVacantesListView">Mis Vacantes</a></li>
                
      </ul>
    </li>

    <li><a class="nav-link" href="?cargar=EmpresasListView">🏢 Empresas</a></li> 
     <li><a class="nav-link" href="?cargar=AcercaDeNosotrosView">ℹ️ Nosotros</a></li>
     <li><a class="nav-link" href="?cargar=ContactoView">📧 Contacto</a></li>
     
    </ul><!-- Acciones -->
    <div class="navbar-actions">
     <div class="user-badge">
      <div class="user-icon">
       👤
      </div><a class="nav-link" href="?cargar=PerfilEmpresaView"><span>Empresa</span></a>
     </div></a>
    </div>
      <a href="?cargar=closeSession" 
            class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded transition duration-300 ease-in-out shadow-md">
              <span>🚪</span> 
            <span>Salir</span>
      </a>
   </div>
   <script>
    // Obtener los elementos por sus IDs
    const toggle = document.getElementById('vacantesDropdownToggle');
    const menu = document.getElementById('vacantesDropdownMenu');

    // Manejar el click en el botón de "Vacantes"
    toggle.addEventListener('click', function(event) {
        // Detiene la propagación para que el documento no lo cierre inmediatamente
        event.stopPropagation(); 
        // Alterna la clase 'hidden': si está oculta, la muestra; si está visible, la oculta.
        menu.classList.toggle('hidden'); 
    });

    // Manejar el click en el documento entero para cerrar el menú
    document.addEventListener('click', function(event) {
        // Si el click no ocurrió dentro del botón (toggle) Y no ocurrió dentro del menú
        if (!toggle.contains(event.target) && !menu.contains(event.target)) {
            // Oculta el menú
            menu.classList.add('hidden');
        }
    });
  </script>

    <section>
          <?php
            $enrutador = new RouterEmpresa;
            if(isset($_GET['cargar']))
            if($enrutador->validarGET($_GET['cargar'])){
                $enrutador->cargarVista($_GET['cargar']);
              }
          ?>
    </section>
  </body>

 