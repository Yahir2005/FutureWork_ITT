<?php
require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
require_once __DIR__ . "/../../Dto/Vacantes.php";

/* ARRAYS */
$listarValidacionVacante = [];
$listarTipoContrato = [];
$listarTipoModalidad = [];

/* CONTROLLERS */
$usuarioController = new UsuarioController();
$vacanteController = new VacanteController();
$vacanteValidacionController = new EstadoValidacionVacanteController();
$TipoContratoController = new TipoContratoController();
$TipoModalidadController = new TipoModalidadController();

/* LISTAR */
$resultListarValidacionVacante = $vacanteValidacionController->listarEstadoValidacionVacante();
$resultListarTipoContrato = $TipoContratoController->listarTipoContrato();
$resultListarTipoModalidad = $TipoModalidadController->listarTipoModalidad();

if($resultListarValidacionVacante->status == "OK"){
    $listarValidacionVacante = $resultListarValidacionVacante->body;
}

if($resultListarTipoContrato->status == "Ok"){
    $listarTipoContrato = $resultListarTipoContrato->body;
}

if($resultListarTipoModalidad->status == "ok"){
    $listarTipoModalidad = $resultListarTipoModalidad->body;
}

/* INSERTAR */
if(isset($_POST["registrarVacante"])){

    $idUsuario = $_SESSION["idUsuarios"];

    $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);

    $datos = $result->body;

    $idEmpresa = null;
    if (is_array($datos) || $datos instanceof ArrayAccess) {
        $idEmpresa = $datos['empresaId'] ?? null;
    } elseif (is_object($datos)) {
        $idEmpresa = $datos->empresaId ?? null;
    }

    if (empty($idEmpresa)) {
        echo "<div class='alert alert-danger'>❌ No se pudo obtener la empresa asociada al usuario.</div>";
        return;
    }

    $vacanteObject = new Vacantes();

    $vacanteObject->set("Empresa_idEmpresa", $idEmpresa);
    $vacanteObject->set("EstadoValidacionVacante_idEstadoValidacionVacante", $_POST["idEstadoValidacionVacante"]);
    $vacanteObject->set("TipoContrato_idTipoContrato", $_POST["idTipoContrato"]);
    $vacanteObject->set("TipoModalidad_idTipoModalidad", $_POST["idTipoModalidad"]);
    $vacanteObject->set("titulo", $_POST["titulo"]);
    $vacanteObject->set("descripcion", $_POST["descripcion"]);
    $vacanteObject->set("requisitos", $_POST["requisitos"]);
    $vacanteObject->set("ubicacion", $_POST["ubicacion"]);
    $vacanteObject->set("salario", $_POST["salario"]);
    $vacanteObject->set("fechaLimite", $_POST["fechaLimite"]);

    $resultVacante = $vacanteController->InsertarVacante($vacanteObject);

    if ($resultVacante->status == 'ok') {

        echo "
        <div class='alert alert-success'>
            ✅ Vacante publicada correctamente
        </div>
        ";

    } else {

        echo "
        <div class='alert alert-danger'>
            ❌ Error al registrar:
            ".$resultVacante->message."
        </div>
        ";
    }
}
?>

<link rel="stylesheet" href="css/VacantesAddView.css?v=5">

<div class="main-wrapper">

    <!-- =========================================
         HERO SECTION
    ========================================== -->
    <section class="hero-vacante">

        <div class="hero-content">

            <div class="hero-left">

                <div class="hero-badge">
                    🚀 Reclutamiento Empresarial Premium
                </div>

                <h1 class="hero-title">
                    Publica una Nueva Vacante
                </h1>

                <p class="hero-text">
                    Encuentra talento universitario altamente capacitado
                    mediante una experiencia moderna, intuitiva y profesional
                    diseñada para empresas innovadoras.
                </p>

                <div class="hero-mini-stats">

                    <div class="mini-stat-card">
                        <strong>+5K</strong>
                        <span>Estudiantes</span>
                    </div>

                    <div class="mini-stat-card">
                        <strong>+120</strong>
                        <span>Empresas</span>
                    </div>

                    <div class="mini-stat-card">
                        <strong>24/7</strong>
                        <span>Postulaciones</span>
                    </div>

                </div>

            </div>

        </div>

        <!-- DECORATIONS -->
        <div class="hero-floating float-1">💼</div>
        <div class="hero-floating float-2">🚀</div>
        <div class="hero-floating float-3">🏢</div>

        <div class="building building-1"></div>
        <div class="building building-2"></div>

    </section>

    <!-- =========================================
         FORM
    ========================================== -->
    <div class="form-wrapper">

        <form method="POST" action="">

            <!-- =============================
                 INFORMACIÓN GENERAL
            ============================== -->
            <div class="form-card">

                <div class="card-glow"></div>

                <h2 class="section-title">
                    <span>📋</span>
                    Información General
                </h2>

                <p class="section-description">
                    Datos principales de la vacante laboral.
                </p>

                <div class="form-grid">

                    <!-- TITULO -->
                    <div class="form-group">

                        <label for="titulo">
                            Título de la Vacante
                            <span class="required">*</span>
                        </label>

                        <div class="input-container">

                            <span class="input-icon">💼</span>

                            <input
                                type="text"
                                id="titulo"
                                name="titulo"
                                required
                                placeholder="Ej: Desarrollador Frontend React"
                            >

                        </div>

                    </div>

                    <!-- UBICACION -->
                    <div class="form-group">

                        <label for="ubicacion">
                            Ubicación
                            <span class="required">*</span>
                        </label>

                        <div class="input-container">

                            <span class="input-icon">📍</span>

                            <input
                                type="text"
                                id="ubicacion"
                                name="ubicacion"
                                required
                                placeholder="Ej: Puebla, México"
                            >

                        </div>

                    </div>

                    <!-- SALARIO -->
                    <div class="form-group">

                        <label for="salario">
                            Salario Mensual
                        </label>

                        <div class="input-container">

                            <span class="input-icon">💰</span>

                            <input
                                type="number"
                                id="salario"
                                name="salario"
                                min="0"
                                step="0.01"
                                placeholder="Ej: 15000"
                            >

                        </div>

                    </div>

                    <!-- FECHA -->
                    <div class="form-group">

                        <label for="fechaLimite">
                            Fecha Límite
                        </label>

                        <div class="input-container">

                            <span class="input-icon">📅</span>

                            <input
                                type="date"
                                id="fechaLimite"
                                name="fechaLimite"
                            >

                        </div>

                    </div>

                    <!-- DESCRIPCION -->
                    <div class="form-group form-group-full">

                        <label for="descripcion">
                            Descripción
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            required
                            placeholder="Describe funciones, responsabilidades, beneficios y objetivos del puesto..."
                        ></textarea>

                    </div>

                </div>

            </div>

            <!-- =============================
                 CONFIGURACIÓN
            ============================== -->
            <div class="form-card">

                <div class="card-glow"></div>

                <h2 class="section-title">
                    <span>⚙️</span>
                    Configuración de Vacante
                </h2>

                <p class="section-description">
                    Define modalidad, contrato y estado de publicación.
                </p>

                <div class="form-grid">

                    <!-- ESTADO -->
                    <div class="form-group">

                        <label for="idEstadoValidacionVacante">
                            Estado
                            <span class="required">*</span>
                        </label>

                        <select
                            id="idEstadoValidacionVacante"
                            name="idEstadoValidacionVacante"
                            required
                        >

                            <option value="">
                                Selecciona un estado
                            </option>

                            <?php foreach($listarValidacionVacante as $item): ?>

                                <option value="<?= $item['idEstadoValidacionVacante'] ?>">

                                    <?= $item['estadoValidacionVacante'] ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- CONTRATO -->
                    <div class="form-group">

                        <label for="idTipoContrato">
                            Tipo de Contrato
                            <span class="required">*</span>
                        </label>

                        <select
                            id="idTipoContrato"
                            name="idTipoContrato"
                            required
                        >

                            <option value="">
                                Selecciona contrato
                            </option>

                            <?php foreach($listarTipoContrato as $tipo): ?>

                                <option value="<?= $tipo['idTipoContrato'] ?>">

                                    <?= $tipo['estadoContrato'] ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- MODALIDAD -->
                    <div class="form-group">

                        <label for="idTipoModalidad">
                            Modalidad
                            <span class="required">*</span>
                        </label>

                        <select
                            id="idTipoModalidad"
                            name="idTipoModalidad"
                            required
                        >

                            <option value="">
                                Selecciona modalidad
                            </option>

                            <?php foreach($listarTipoModalidad as $modalidad): ?>

                                <option value="<?= $modalidad['idTipoModalidad'] ?>">

                                    <?= $modalidad['tipoModalidad'] ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

            </div>

            <!-- =============================
                 REQUISITOS
            ============================== -->
            <div class="form-card">

                <div class="card-glow"></div>

                <h2 class="section-title">
                    <span>🎓</span>
                    Requisitos y Habilidades
                </h2>

                <p class="section-description">
                    Define conocimientos técnicos y habilidades necesarias.
                </p>

                <div class="form-group">

                    <textarea
                        id="requisitos"
                        name="requisitos"
                        placeholder="Ej: React, Laravel, APIs REST, Git, trabajo en equipo, metodologías ágiles..."
                    ></textarea>

                </div>

            </div>

            <!-- =============================
                 ACTIONS
            ============================== -->
            <div class="form-actions">

                <button
                    type="submit"
                    name="registrarVacante"
                    class="btn-submit"
                >
                    🚀 Publicar Vacante
                </button>

                <a
                    href="?cargar=Home"
                    class="btn-cancel"
                >
                    ✖ Cancelar
                </a>

            </div>

        </form>

    </div>

</div>