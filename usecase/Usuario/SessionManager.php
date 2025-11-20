<?php
 
 class SessionManager {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Verificar si el usuario ha iniciado sesión
    public static function isUserLoggedIn() {
        self::startSession();
        return isset($_SESSION['idUsuarios']);
    }

    // Obtener el ID del usuario
    public static function getUserId() {
        self::startSession();
        return $_SESSION['idUsuarios'] ?? null;
    }

    public static function getRoleId() {
        self::startSession();
        return $_SESSION['Rol_idRol'] ?? null;
    }

    public static function getEmpresaId() {
        self::startSession();
        return $_SESSION['idEmpresas'] ?? null;
    }


    // Destruir la sesión
    public static function destroySession() {
        self::startSession();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
       
    }
 }