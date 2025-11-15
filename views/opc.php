<?php
// navbarEmpresa.php
// Se asume que este archivo está dentro de la carpeta 'views'

// 1. Incluimos el SessionManager y el Router de Empresa
require_once __DIR__ .'/../usecase/Usuario/SessionManager.php';
require_once __DIR__ .'/../router/RouterEmpresa.php';

// 2. SEGURIDAD: Verificamos la sesión y el rol
$idRol = SessionManager::getRoleId();

// Si no es Rol 1 (Empresa), lo sacamos al login
if ($idRol !== 1) { 
    // (Asumiendo que login.php está dos niveles arriba de 'views')
    header("Location: ../login.php"); 
    exit;
}

// 3. Lógica del Router para cargar la vista
$router = new RouterEmpresa();

// Obtenemos la vista de la URL, ej: navbarEmpresa.php?vista=Inicio
// Si no hay vista, cargamos "Inicio" por defecto
$vista = $_GET['vista'] ?? 'Inicio'; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Empresa - FutureWork ITT</title>
    <link rel="stylesheet" href="css/tu_estilo.css">
</head>
<body>

    <header>
        <nav>
            <a href="navbarEmpresa.php?vista=Inicio">Inicio</a>
            
            <a href="navbarEmpresa.php?vista=Ver_Vacantes_Empresa">Mis Vacantes</a>
            <a href="navbarEmpresa.php?vista=Ver_Postulantes">Ver Postulantes</a>
            <a href="navbarEmpresa.php?vista=Perfil_Empresa_Usuario">Mi Perfil</a>
            
            <a href="navbarEmpresa.php?vista=EXIT">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <?php
            // El router decide qué archivo .php incluir aquí
            $router->CargarVista($vista);
        ?>
    </main>

    <footer>
        </footer>

</body>
</html>