<?php
require_once __DIR__ . '/usecase/Usuario/SessionManager.php';
require_once __DIR__ . '/router/RouterEmpresa.php';
require_once __DIR__ . '/router/RouterPostulante.php';
require_once __DIR__ . '/router/Router.php';

// Iniciar y validar la sesión
SessionManager::startSession();
if (!SessionManager::isUserLoggedIn()) {
    // Si no hay sesión, se redirige a la página de login
    header("Location: login.php");
    exit();
}

// Obtener el ID del rol de la sesión
$idRol = SessionManager::getRoleId();

// Obtener la vista solicitada de la URL
$vista = $_GET['vista'] ?? 'Inicio'; // Vista por defecto

// Seleccionar el router adecuado según el rol del usuario
// Rol 1 = Postulante, Rol 2 = Empresa (esto es un supuesto, ajústalo a tu base de datos)
if ($idRol == 1) { 
    $router = new RouterPostulante();
} elseif ($idRol == 2) {
    $router = new RouterEmpresa();
} else {
    // Si no tiene un rol definido o es un rol genérico, usamos el router base
    // O podrías destruir la sesión y enviarlo al login con un error.
    $router = new Router();
}

// Cargar la vista solicitada usando el router seleccionado
$router->CargarVista($vista);