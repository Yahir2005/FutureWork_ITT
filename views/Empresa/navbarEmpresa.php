<?php
    include_once __DIR__ . "/../../router/RouterEmpresa.php";
    include_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";
    require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

    $nombreEmpresa = "Mi Empresa";

    if(!SessionManager::isUserLoggedIn()){
        header("Location: ../index.php");
        exit;
    }
    if (isset($_SESSION["idUsuarios"])) {
        $idUsuario = $_SESSION["idUsuarios"];
        $usuarioController = new UsuarioController();
        $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
        
        if ($result && isset($result->body) && isset($result->body['nombreEmpresa'])) {
            $nombreEmpresa = $result->body['nombreEmpresa'];
        }
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
    <nav class="navbar navbar-expand-lg py-3" style="background-color: #2a5298; " data-bs-theme="light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#"><?php echo $nombreEmpresa; ?></a>

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
                            🧔‍♂️ Administradores Empresa
                        </a>
                        <ul class="dropdown-menu" style="background-color:#2a5298;">
                        <li>
                            <a class="dropdown-item text-white" href="?cargar=VacantesAddView">Listar Administradores</a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item text-white" href="?cargar=MisVacantesListView">Agregar Administrador</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item text-white" href="?cargar=VacantesUpdateView">Editar Vacante</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            💼 Vacantes
                        </a>
                        <ul class="dropdown-menu" style="background-color:#2a5298;">

                        <li>
                            <a class="dropdown-item text-white" href="?cargar=VacantesAddView">Agregar Vacantes</a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-white" href="?cargar=VacantesListView">Listar Vacantes</a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item text-white" href="?cargar=MisVacantesListView">Mis Vacantes</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item text-white" href="?cargar=VacantesUpdateView">Editar Vacante</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="?cargar=Empleados">👥 Postulante</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">🏢 Empresas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">📧 Contacto</a>
                    </li>

                </ul>
            </div>
        </div>
        <li class="nav-item ms-lg-auto"> <a class="nav-link text-white fw-bold" href="?cargar=closeSession">
        [Salir]
            </a>
        </li>
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