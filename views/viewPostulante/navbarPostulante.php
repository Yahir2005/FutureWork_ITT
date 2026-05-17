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

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- TU HOJA DE ESTILOS PERSONALIZADA (Premium UI) -->
    <link rel="stylesheet" href="./css/NavbarPostulante.css">

    <style>
        @view-transition {
            navigation: auto;
        }
    </style>

    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
    <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
</head>

<body>

   <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm style-navbar-premium">
    <div class="container">
        
        <a class="navbar-brand d-flex align-items-center gap-3 text-white fw-bold" href="?cargar=Home">
            <img 
                src="../../LOGO KLIVYFY.png" 
                alt="Klifify Logo" 
                width="40" 
                height="40" 
                class="d-inline-block align-top object-contain"
            >
            <span class="fs-5 letter-spacing-custom">Klivify</span>
        </a>

        <button 
            class="navbar-toggler border-0" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNavMain" 
            aria-controls="navbarNavMain" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavMain">
            
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0 gap-1 text-center">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-3 style-nav-item" href="?cargar=Home">🏠 Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-3 style-nav-item" href="?cargar=VacantesListView">💼 Vacantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-3 style-nav-item" href="?cargar=EmpresasListView">🏢 Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-3 style-nav-item" href="?cargar=AcercaDeNosotrosView">ℹ️ Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-3 style-nav-item" href="?cargar=ContactoView">📧 Contacto</a>
                </li>
            </ul>

            <div class="d-flex flex-column flex-lg-row align-items-center gap-3">
                
                <div class="d-flex align-items-center gap-2 bg-white bg-opacity-10 text-white rounded-pill px-3 py-2 style-user-badge w-100-mobile justify-content-center">
                    <div class="d-flex align-items-center justify-content-center bg-white text-primary rounded-circle fw-bold" style="width: 30px; height: 30px; font-size: 14px;">
                        👤
                    </div>
                    <a href="?cargar=PerfilPostulanteView" class="text-white text-decoration-none fw-bold small">
                        Postulante
                    </a>
                </div>

                <a href="?cargar=closeSession" class="btn btn-danger fw-bold btn-sm px-3 py-2 rounded-3 d-flex align-items-center gap-2 shadow-sm w-100-mobile justify-content-center style-btn-salir">
                    <span>🚪</span> Salir
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

    <!-- Bootstrap JS Bundle -->
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>