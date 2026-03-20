<?php
include_once("/../../router/RouterEmpresa.php");
include_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";
require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

if(!SessionManager::isUserLoggedIn()){
      header("Location: ../index.php");
      exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Empresa</title>
    
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
        <nav class="navbar navbar-light mt-2" style="background-color: rgb(21, 94, 146);">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar Light</a>
            </div>
        </nav>
    </div>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>