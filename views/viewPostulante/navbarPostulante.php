<?php
    include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: ../../index.php");
      exit();
    }
?>
<!-- Navbar -->
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
 </div>
</nav>