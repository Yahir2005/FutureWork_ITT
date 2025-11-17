<?php
// opc.php - Orquestador de redirección por rol

// Rutas a los archivos, que has corregido correctamente.
require_once __DIR__ . "/../usecase/Usuario/SessionManager.php";
require_once __DIR__ . '/../usecase/Usuario/UsuarioController.php';

SessionManager::startSession();

// Verificamos si el usuario ha iniciado sesión
if (!SessionManager::isUserLoggedIn()) {
    // --- CORRECCIÓN DE RUTA ---
    // Redirigimos al index.php en el directorio raíz.
    header('Location: ../index.php');
    exit();
}

// Obtenemos el ID de usuario que guardamos en la sesión durante el login
$idUsuario = SessionManager::getUserId();

// Si por alguna razón el ID es nulo o cero (invitado), lo sacamos.
if (empty($idUsuario)) {
    // --- CORRECCIÓN DE RUTA ---
    header('Location: ../index.php');
    exit();
}

// Comprobamos si ya tenemos el rol en la sesión para no consultar la BD cada vez
if (SessionManager::getRoleId() !== null && SessionManager::getRoleId() != 0) { // Añadida comprobación para rol 0
    $idRol = SessionManager::getRoleId();
} else {
    // Si no tenemos el rol, lo buscamos en la base de datos
    $controller = new UsuarioController();
    $response = $controller->obtenerUsuarioPorId($idUsuario);

    if ($response->status == "ok") {
        $usuario = $response->body;
        $idRol = $usuario['Rol_idRol'];
        $_SESSION['Rol_idRol'] = $idRol;
    } else {
        // Si no se encuentra el usuario (quizás fue borrado), destruimos la sesión y lo mandamos al login
        SessionManager::destroySession();
        // --- CORRECIÓN DE RUTA ---
        header('Location: ../index.php?error=user_not_found');
        exit();
    }
}

// --- Redirección final basada en el ROL ---
// Asumimos: 1 = Postulante, 2 = Empresa
// Tus cambios para redirigir a los navbars son correctos.
if ($idRol == 1) {
    // Redirigimos al navbar del Postulante
    header('Location: navbarPostulante.php');
    exit();
} elseif ($idRol == 2) {
    // Redirigimos al navbar de la Empresa
    header('Location: navbarEmpresa.php');
    exit();
} else {
    // Si el rol es desconocido, mostramos un error y destruimos la sesión.
    SessionManager::destroySession();
    echo "Error: Rol de usuario no reconocido. Por favor, contacta a soporte.";
    exit();
}
