<?php
require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';
require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';

/* =========================================================
   VALIDACIONES
========================================================= */

$listarValidaciones = array();

$estadoValidacionEmpresaController = new EstadoValidacionEmpresaController();

$resultValidaciones = $estadoValidacionEmpresaController->ListarValidacionesEmpresa();

if(strtolower($resultValidaciones->status) == "ok"){

    foreach($resultValidaciones->body as $estado){

        $listarValidaciones[$estado["idEstadoValidacionEmpresa"]] =
        $estado["estadoValidacionEmpresa"];
    }
}

/* =========================================================
   EMPRESAS
========================================================= */

$controller = new EmpresaController();

$listar = array();

$resultEmpresas = $controller->listarEmpresas();

if(strtolower($resultEmpresas->status) == "ok"){

    $listar = $resultEmpresas->body;
}

/* =========================================================
   VACANTES
========================================================= */

$vacanteController = new VacanteController();

/* =========================================================
   FILTROS
========================================================= */

if(isset($_GET["buscar"])){

    $nombre = trim($_GET["nombre"] ?? "");
    $sector = trim($_GET["sector"] ?? "");
    $validacion = trim($_GET["validacion"] ?? "");

    $filtrado = $listar;

    if(!empty($nombre)){

        $filtrado = array_filter($filtrado,function($empresa) use ($nombre){

            return stripos(
                $empresa["nombreEmpresa"],
                $nombre
            ) !== false;
        });
    }

    if(!empty($sector)){

        $filtrado = array_filter($filtrado,function($empresa) use ($sector){

            return stripos(
                $empresa["sector"],
                $sector
            ) !== false;
        });
    }

    if(!empty($validacion)){

        $filtrado = array_filter($filtrado,function($empresa) use ($validacion){

            return $empresa["EstadoValidacionEmpresa_idEstadoValidacionEmpresa"] == $validacion;
        });
    }

    $listar = array_values($filtrado);
}
?>

<link rel="stylesheet" href="css/EmpresasListView.css">

<section class="hero-section">

    <!-- EFECTOS -->
    <div class="hero-shape hero-shape-1"></div>
    <div class="hero-shape hero-shape-2"></div>
    <div class="hero-shape hero-shape-3"></div>

    <!-- EDIFICIOS IZQUIERDA -->
    <div class="city-left">
        <div class="building b1"></div>
        <div class="building b2"></div>
        <div class="building b3"></div>
    </div>

    <!-- EDIFICIOS DERECHA -->
    <div class="city-right">
        <div class="building b4"></div>
        <div class="building b5"></div>
        <div class="building b6"></div>
    </div>

    <!-- CONTENIDO -->
    <div class="hero-content">

        <div class="hero-badge">
            🏢 Plataforma Empresarial Inteligente
        </div>

        <h1>
            Descubre Empresas <span>Innovadoras</span>
        </h1>

        <p>
            Explora compañías registradas dentro de la plataforma,
            visualiza sus vacantes activas y conecta con nuevas
            oportunidades laborales mediante una experiencia UIX moderna.
        </p>

    </div>

</section>

<!-- ===================================================== -->
<!-- MAIN -->
<!-- ===================================================== -->

<div class="companies-container">

    <!-- ================================================= -->
    <!-- FILTROS -->
    <!-- ================================================= -->

    <div class="filter-card">

        <div class="filter-header">

            <h2>
                🔎 Buscar Empresas
            </h2>

            <p>
                Filtra compañías por nombre, sector o estado
                de validación.
            </p>

        </div>

        <!-- FORM -->
        <form method="GET" action="" class="filter-form">

            <!-- IMPORTANTE -->
            <input type="hidden" name="cargar" value="EmpresasListView">

            <!-- NOMBRE -->
            <div class="input-group">

                <label for="nombre">
                    Nombre Empresa
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    placeholder="Ej. TechVerse"
                    value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>"
                >

            </div>

            <!-- SECTOR -->
            <div class="input-group">

                <label for="sector">
                    Sector
                </label>

                <input
                    type="text"
                    id="sector"
                    name="sector"
                    placeholder="Tecnología, Salud..."
                    value="<?php echo isset($_GET['sector']) ? htmlspecialchars($_GET['sector']) : ''; ?>"
                >

            </div>

            <!-- VALIDACION -->
            <div class="input-group">

                <label for="validacion">
                    Estado
                </label>

                <select id="validacion" name="validacion">

                    <option value="">
                        Todos
                    </option>

                    <?php foreach($listarValidaciones as $id => $nombre): ?>

                        <option
                            value="<?php echo $id; ?>"
                            <?php echo (isset($_GET['validacion']) && $_GET['validacion'] == $id) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($nombre); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- BOTONES -->
            <div class="filter-actions">

                <button
                    type="submit"
                    class="btn-primary"
                    name="buscar"
                    value="buscar"
                >
                    🔍 Buscar
                </button>

                <a
                    href="?cargar=EmpresasListView"
                    class="btn-secondary"
                >
                    ✨ Limpiar
                </a>

            </div>

        </form>

    </div>

    <!-- ================================================= -->
    <!-- GRID -->
    <!-- ================================================= -->

    <div class="companies-grid">

        <?php if(count($listar) > 0): ?>

            <?php $currentDate = date('Y-m-d'); ?>

            <?php foreach($listar as $empresa): ?>

                <?php

                $resultVacantes =
                $vacanteController->ListarVacantesPorEmpresa(
                    $empresa['idEmpresas']
                );

                $countVacantes = 0;
                $countAbiertas = 0;

                if(
                    isset($resultVacantes->status)
                    &&
                    strtolower($resultVacantes->status) == "ok"
                    &&
                    is_array($resultVacantes->body)
                ){

                    $countVacantes = count($resultVacantes->body);

                    foreach($resultVacantes->body as $vacante){

                        if(
                            isset($vacante['fechaLimite'])
                            &&
                            $vacante['fechaLimite'] >= $currentDate
                        ){
                            $countAbiertas++;
                        }
                    }
                }

                $estado =
                intval(
                    $empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']
                );

                $textoEstado = "Pendiente";
                $claseEstado = "status-warning";

                if($estado == 1){
                    $textoEstado = "✓ Validada";
                    $claseEstado = "status-success";
                }

                if($estado == 3){
                    $textoEstado = "✕ Rechazada";
                    $claseEstado = "status-danger";
                }

                ?>

                <!-- CARD -->
                <div class="company-card">

                    <div class="card-glow"></div>

                    <!-- TOP -->
                    <div class="company-top">

                        <div class="company-logo">
                            🏢
                        </div>

                        <span class="status <?php echo $claseEstado; ?>">
                            <?php echo $textoEstado; ?>
                        </span>

                    </div>

                    <!-- INFO -->
                    <div class="company-info">

                        <h3>
                            <?php echo htmlspecialchars($empresa['nombreEmpresa']); ?>
                        </h3>

                        <span class="sector">
                            <?php echo htmlspecialchars($empresa['sector']); ?>
                        </span>

                        <p>
                            <?php echo htmlspecialchars($empresa['descripcion']); ?>
                        </p>

                    </div>

                    <!-- STATS -->
                    <div class="stats">

                        <div class="stat-box">

                            <h4>
                                <?php echo $countVacantes; ?>
                            </h4>

                            <span>
                                Vacantes
                            </span>

                        </div>

                        <div class="stat-box">

                            <h4>
                                <?php echo $countAbiertas; ?>
                            </h4>

                            <span>
                                Abiertas
                            </span>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer">

                        <a
                            href="?cargar=PerfilEmpresaView&id=<?php echo $empresa['idEmpresas']; ?>"
                            class="btn-outline"
                        >
                            👁 Ver Perfil
                        </a>

                        <a
                            href="?cargar=VacantesListView&idEmpresa=<?php echo $empresa['idEmpresas']; ?>"
                            class="btn-gradient"
                        >
                            💼 Vacantes
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-state">

                <div class="empty-state-icon">
                    🏢
                </div>

                <h3>
                    No se encontraron empresas
                </h3>

                <p>
                    No existen empresas registradas actualmente.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>