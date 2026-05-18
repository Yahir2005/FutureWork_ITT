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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/NavbarPostulante.css">

    <style>
        @view-transition {
            navigation: auto;
        }
    </style>

</head>

<body>

<!-- =========================
     NAVBAR PREMIUM KLIVIFY
========================= -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-klivify">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center gap-3" href="?cargar=Home">
            <img 
                src="../../LOGO KLIVYFY.png"
                alt="Logo Klivify"
                class="logo-klivify"
            >

            <div class="brand-text">
                <span>Klivify</span>
            </div>
        </a>

        <!-- BOTON MOBILE -->
        <button 
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
            aria-controls="navbarMain"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarMain">

            <!-- LINKS -->
            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a class="nav-link nav-link-klivify" href="?cargar=Home">
                        🏠 Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-klivify" href="?cargar=VacantesListView">
                        💼 Vacantes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-klivify" href="?cargar=EmpresasListView">
                        🏢 Empresas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-klivify" href="?cargar=AcercaDeNosotrosView">
                        ℹ️ Nosotros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-klivify" href="?cargar=ContactoView">
                        📧 Contacto
                    </a>
                </li>

            </ul>

            <!-- USER ACTIONS -->
            <div class="d-flex flex-column flex-lg-row align-items-center gap-3">

                <!-- PERFIL -->
                <a href="?cargar=PerfilPostulanteView"
                   class="user-badge text-decoration-none">
                    <span class="user-icon">👤</span>
                    <span class="user-text">Postulante</span>
                </a>

                <!-- SALIR -->
                <a href="?cargar=closeSession"
                   class="btn-salir text-decoration-none">
                    🚪 Salir
                </a>

            </div>

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
                    echo "<p class='text-center mt-5'>Página no encontrada.</p>";
                }

            } else {
                $enrutador->cargarVista('Home');
            }
        ?>

    </section>
</main>

<!-- Bootstrap -->
<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>