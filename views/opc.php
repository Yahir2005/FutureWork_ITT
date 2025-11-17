<?php
// Incluimos el SessionManager para poder usar sus métodos
require_once __DIR__ . '/usecase/Usuario/SessionManager.php';

// Iniciamos la sesión para poder acceder a las variables de $_SESSION
SessionManager::startSession();

// Verificamos que el usuario haya iniciado sesión
if (!SessionManager::isUserLoggedIn()) {
    // Si no ha iniciado sesión, lo redirigimos al login
    header('Location: index.php');
    exit();
}

// Obtenemos el ID del rol de la sesión
$idRol = SessionManager::getRoleId();

// Redirigimos en base al idRol
if ($idRol == 2) {
    // Rol de Postulante
    header('Location: navbarPostulante.php');
    exit();
} elseif ($idRol == 1) {
    // Rol de Empresa
    header('Location: navbarEmpresa.php');
    exit();
} else {
    // Si el rol no es 1 ni 2, o es nulo, podemos redirigir a una página por defecto o mostrar un error.
    // Por ejemplo, redirigir al login o a una página de error.
    echo "Error: Rol de usuario no válido o no definido.";
    // Opcionalmente, destruir la sesión y redirigir al login
    // SessionManager::destroySession();
    // header('Location: index.php');
    // exit();
}
?>