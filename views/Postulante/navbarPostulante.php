<?php
    include_once("../../router/RouterPostulante.php");
    include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";
    require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: ../index.php");
      exit;
    }

    $nombreCompleto = "Mi Perfil";

    if (isset($_SESSION["idUsuarios"])) {
        $idUsuario = $_SESSION["idUsuarios"];
        $usuarioController = new UsuarioController();
        $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
        
        if ($result && isset($result->body) && isset($result->body['nombreCompleto'])) {
            $nombreCompleto = $result->body['nombreCompleto'];
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Postulante</title>
    
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Cambié el color a un tono azul más oscuro para diferenciarlo de la empresa -->
    <nav class="navbar navbar-expand-lg py-3 shadow-sm" style="background-color: #1a3a6c;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#"><?php echo $nombreCompleto; ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="?cargar=Home">🏠 Inicio</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            💼 Oportunidades
                        </a>
                        <ul class="dropdown-menu shadow" style="background-color:#1a3a6c;">
                            <li><a class="dropdown-item text-white" href="?cargar=VacantesListView">Explorar Vacantes</a></li>
                            <li><hr class="dropdown-divider border-light"></li>
                            <li><a class="dropdown-item text-white" href="?cargar=MisPostulacionesView">Mis Postulaciones</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="?cargar=EmpresasListView">🏢 Ver Empresas</a>
                    </li>

                    <li class="nav-item border-start ms-lg-2 ps-lg-3">
                        <a class="nav-link text-white" href="?cargar=Ver_Postulantes">👥 Directorio de Egresados</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="?cargar=ContactoView">📧 Ayuda / Contacto</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3"> 
                        <a class="nav-link text-white fw-bold d-flex align-items-center" href="?cargar=PerfilPostulanteView">
                            <span class="me-2">👤</span> 
                        </a>
                    </li>

                    <li class="nav-item"> 
                        <a class="btn btn-sm btn-outline-warning fw-bold" href="?cargar=closeSession">
                            Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container-fluid mt-4">
        
    </section>

    <section>
            <?php
                $enrutador = new RouterPostulante();
                if(isset($_GET['cargar']))
                if($enrutador->validarGET($_GET['cargar'])){
                    $enrutador->cargarVista($_GET['cargar']);
                }
            ?>
    </section>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>