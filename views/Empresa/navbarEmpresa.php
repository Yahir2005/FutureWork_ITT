<?php
include_once __DIR__ . "/../../router/RouterEmpresa.php";
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Empresa</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?cargar=Home">Inicio</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="?cargar=Empleados">Empleados</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configuración</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <?php
            $enrutador = new RouterEmpresa();
            if (isset($_GET['cargar']) && $enrutador->validarGET($_GET['cargar'])) {
                $enrutador->CargarVista($_GET['cargar']);
            }
        ?>
    </section>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>