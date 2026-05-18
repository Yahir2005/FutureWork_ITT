<?php
include_once("../../router/RouterEmpresa.php");
include_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";
require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

if(!SessionManager::isUserLoggedIn()){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Klivify - Panel Empresa</title>

    <!-- BOOTSTRAP -->
    <link
        rel="stylesheet"
        href="../../node_modules/bootstrap/dist/css/bootstrap.min.css"
    >

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="./css/NavbarEmpresa.css?v=10"
    >

</head>

<body>

<!-- ========================================
     NAVBAR
======================================== -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-klivify fixed-top">

    <div class="container">

        <!-- LOGO -->
        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="?cargar=Home"
        >

            <img
                src="../../LOGO KLIVYFY.png"
                alt="Klivify"
                class="navbar-logo"
            >

            <span class="brand-text">
                Klivify
            </span>

        </a>

        <!-- TOGGLER -->
        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarEmpresa"
        >

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- CONTENIDO -->
        <div
            class="collapse navbar-collapse"
            id="navbarEmpresa"
        >

            <!-- MENU -->
            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-2">

                <!-- INICIO -->
                <li class="nav-item">

                    <a
                        class="nav-link nav-link-klivify"
                        href="?cargar=Home"
                    >
                        🏠 Inicio
                    </a>

                </li>

                <!-- VACANTES -->
                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle nav-link-klivify"
                        href="#"
                        id="vacantesDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                    >
                        💼 Vacantes
                    </a>

                    <ul class="dropdown-menu dropdown-menu-klivify">

                        <li>

                            <a
                                class="dropdown-item"
                                href="?cargar=VacantesAddView"
                            >
                                ➕ Publicar Vacante
                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="?cargar=VacantesListView"
                            >
                                📋 Ver Vacantes
                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="?cargar=MisVacantesListView"
                            >
                                🧠 Mis Vacantes
                            </a>

                        </li>

                    </ul>

                </li>

                <!-- EMPRESAS -->
                <li class="nav-item">

                    <a
                        class="nav-link nav-link-klivify"
                        href="?cargar=EmpresasListView"
                    >
                        🏢 Empresas
                    </a>

                </li>

                <!-- NOSOTROS -->
                <li class="nav-item">

                    <a
                        class="nav-link nav-link-klivify"
                        href="?cargar=AcercaDeNosotrosView"
                    >
                        ℹ️ Nosotros
                    </a>

                </li>

                <!-- CONTACTO -->
                <li class="nav-item">

                    <a
                        class="nav-link nav-link-klivify"
                        href="?cargar=ContactoView"
                    >
                        📧 Contacto
                    </a>

                </li>

                <!-- CHATBOT -->
                <li class="nav-item">

                    <a
                        class="nav-link nav-link-klivify chatbot-link"
                        href="?cargar=Chatbot"
                    >
                        🤖 Chatbot IA
                    </a>

                </li>

            </ul>

            <!-- ACTIONS -->
            <div class="navbar-actions">

                <!-- PERFIL -->
                <a
                    href="?cargar=PerfilEmpresaView"
                    class="profile-badge"
                >

                    <div class="profile-icon">
                        👤
                    </div>

                    <span>
                        Empresa
                    </span>

                </a>

                <!-- SALIR -->
                <a
                    href="?cargar=closeSession"
                    class="logout-btn"
                >
                    🚪 Salir
                </a>

            </div>

        </div>

    </div>

</nav>

<!-- ========================================
     MAIN
======================================== -->
<main class="main-layout">

    <section class="content-layout">

        <?php

        $enrutador = new RouterEmpresa();

        if(isset($_GET['cargar'])){

            if($enrutador->validarGET($_GET['cargar'])){

                $enrutador->cargarVista($_GET['cargar']);

            }else{

                echo "
                <div class='page-error'>
                    Página no encontrada.
                </div>
                ";
            }

        }else{

            $enrutador->cargarVista('Home');

        }

        ?>

    </section>

</main>

<!-- BOOTSTRAP -->
<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>