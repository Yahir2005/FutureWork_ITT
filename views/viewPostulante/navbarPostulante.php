<?php
    include_once("../../router/RouterPostulante.php");
    include_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Klivify - Inicio Postulante</title>

    <!-- CSS ORIGINAL -->
<link rel="stylesheet" href="../css/navbar.css">

<!-- NUEVO CSS PERSONALIZADO -->
<link rel="stylesheet" href="../css/NavbarPostulante.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <style>
        @view-transition {
            navigation: auto;
        }
    </style>

    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
    <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="navbar-container">

            <!-- LOGO -->
            <a href="?cargar=Home" class="navbar-logo">

                <div class="logo-circle">

                    <img 
                        src="../../LOGO KLIVYFY.png" 
                        alt="Klivify Logo" 
                        class="logo-img"
                    >

                </div>

                <span class="logo-text">
                    Klivify
                </span>

            </a>

            <!-- MENÚ -->
            <ul class="navbar-menu">

                <li>
                    <a class="nav-link" href="?cargar=Home">
                        🏠 Inicio
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="?cargar=VacantesListView">
                        💼 Vacantes
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="?cargar=EmpresasListView">
                        🏢 Empresas
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="?cargar=AcercaDeNosotrosView">
                        ℹ️ Nosotros
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="?cargar=ContactoView">
                        📧 Contacto
                    </a>
                </li>

            </ul>

            <!-- ACCIONES DERECHA -->
            <div class="navbar-actions">

                <!-- PERFIL -->
                <div class="user-badge">

                    <div class="user-icon">
                        👤
                    </div>

                    <a 
                        class="nav-link text-white text-decoration-none" 
                        href="?cargar=PerfilPostulanteView"
                    >
                        <span>Postulante</span>
                    </a>

                </div>

                <!-- BOTÓN SALIR -->
                <a 
                    href="?cargar=closeSession"
                    class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded transition duration-300 ease-in-out shadow-md"
                >

                    <span>🚪</span>

                    <span>Salir</span>

                </a>

            </div>

        </div>

    </nav>

    <!-- CONTENIDO -->
    <main>

        <section>

            <?php

                $enrutador = new RouterPostulante();

                if(isset($_GET['cargar'])){

                    if($enrutador->validarGET($_GET['cargar'])){

                        $enrutador->cargarVista($_GET['cargar']);

                    } else {

                        echo "
                            <p class='text-center mt-5'>
                                Página no encontrada.
                            </p>
                        ";
                    }

                } else {

                    $enrutador->cargarVista('Home');

                }

            ?>

        </section>

    </main>

    <!-- Bootstrap JS -->
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>