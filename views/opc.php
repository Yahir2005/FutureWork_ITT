<?php
require_once __DIR__ . '/../usecase/Usuario/SessionManager.php';
require_once __DIR__ . '/../usecase/Usuario/UsuarioController.php';

SessionManager::startSession();

if (!SessionManager::isUserLoggedIn()) {
    header('Location: /../index.php');
    exit();
}

// Obtenemos el ID de usuario de la sesión
$idUsuario = SessionManager::getUserId();

// Creamos un controlador para buscar los datos del usuario
$controller = new UsuarioController();
$response = $controller->obtenerUsuarioPorId($idUsuario);

if ($response->status == "ok") {
    // Asumimos que $response->body es un objeto o array asociativo con los datos del usuario
    $usuario = $response->body;
    
    // Guardamos el rol en la sesión para no tener que buscarlo en cada página
    $_SESSION['Rol_idRol'] = $usuario['Rol_idRol']; // O $usuario->Rol_idRol si es un objeto
    
    // Redirigimos según el rol
    if ($_SESSION['Rol_idRol'] == 1) {
        header('Location: navbarEmpresa.php');
        exit();
    } elseif ($_SESSION['Rol_idRol'] == 2) {
        header('Location: navbarPostulante.php');
        exit();
    } else {
        echo "Error: Rol de usuario no válido.";
    }

} else {
    echo "Error: No se pudieron obtener los datos del usuario.";
    // Opcional: destruir la sesión si no se encuentra el usuario
    // SessionManager::destroySession();
    // header('Location: index.php');
    // exit();
}