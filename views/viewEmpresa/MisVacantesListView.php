<main class="main-content">

<?php

if (!isset($vacantes) || !is_array($vacantes)) {
    $vacantes = [];
}

if (!isset($totalCandidatos)) {

    $totalCandidatos = 0;

    foreach ($vacantes as $vac) {

        $totalCandidatos += isset($vac['candidatos'])
            ? (int)$vac['candidatos']
            : 0;
    }
}

if (!isset($totalVacantes)) {
    $totalVacantes = count($vacantes);
}

if (!isset($vacantesAbiertas)) {

    $vacantesAbiertas = 0;

    foreach ($vacantes as $vac) {

        if (
            isset($vac['estatus']) &&
            strtolower($vac['estatus']) === 'abierta'
        ) {
            $vacantesAbiertas++;
        }
    }
}

/* MENSAJE SUCCESS */
if(isset($_SESSION['success_message'])){

    echo '
    <div class="alert-success-custom">
        '.$_SESSION['success_message'].'
    </div>
    ';

    unset($_SESSION['success_message']);
}
?>

<link rel="stylesheet" href="css/MisVacantesListView.css">

<!-- HERO -->
<section class="dashboard-hero">

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <div class="hero-text">

            <span class="hero-badge">
                💼 Panel Empresarial
            </span>

            <h1>
                Gestión Inteligente de Vacantes
            </h1>

            <p>
                Administra, supervisa y optimiza todas tus publicaciones
                laborales desde un panel moderno, elegante y profesional.
            </p>

        </div>

        <div class="hero-actions">

            <a
                href="?cargar=VacantesAddView"
                class="hero-btn hero-btn-primary"
            >
                ➕ Nueva Vacante
            </a>

        </div>

    </div>

    <div class="hero-shape hero-shape-1"></div>
    <div class="hero-shape hero-shape-2"></div>

</section>

<!-- STATS -->
<section class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon icon-blue">
            💼
        </div>

        <div class="stat-content">

            <h2>
                <?= $totalVacantes ?>
            </h2>

            <p>
                Total Vacantes
            </p>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon icon-green">
            ✅
        </div>

        <div class="stat-content">

            <h2>
                <?= $vacantesAbiertas ?>
            </h2>

            <p>
                Vacantes Activas
            </p>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon icon-orange">
            👥
        </div>

        <div class="stat-content">

            <h2>
                <?= $totalCandidatos ?>
            </h2>

            <p>
                Total Candidatos
            </p>

        </div>

    </div>

</section>

<!-- SEARCH -->
<section class="search-section">

    <div class="search-header">

        <div>

            <h2>
                🔎 Buscar Vacantes
            </h2>

            <p>
                Encuentra rápidamente publicaciones activas o pausadas.
            </p>

        </div>

    </div>

    <form method="GET" class="search-form">

        <input
            type="hidden"
            name="cargar"
            value="MisVacantesListView"
        >

        <div class="search-box">

            <span class="search-icon">
                🔍
            </span>

            <input
                type="search"
                name="buscar"
                placeholder="Buscar vacante por título..."
            >

        </div>

        <button type="submit" class="btn-search">
            Buscar
        </button>

    </form>

</section>

<!-- TABLE -->
<section class="table-container">

    <div class="table-header">

        <div>

            <h2>
                📋 Mis Publicaciones
            </h2>

            <p>
                <?= $totalVacantes ?> vacantes registradas
            </p>

        </div>

    </div>

    <div class="table-wrapper">

        <table class="modern-table">

            <thead>

                <tr>

                    <th>Vacante</th>
                    <th>Publicado</th>
                    <th>Modalidad</th>
                    <th>Candidatos</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php if (!empty($vacantes)): ?>

                <?php foreach ($vacantes as $vac): ?>

                    <?php

                    $estatus = isset($vac['estatus'])
                        ? strtolower($vac['estatus'])
                        : 'abierta';

                    $badgeClass = 'badge-open';

                    if ($estatus === 'cerrada') {
                        $badgeClass = 'badge-close';
                    }

                    elseif ($estatus === 'pausada') {
                        $badgeClass = 'badge-pause';
                    }

                    ?>

                    <tr>

                        <!-- VACANTE -->
                        <td>

                            <div class="vacante-info">

                                <div class="vacante-icon">
                                    💼
                                </div>

                                <div>

                                    <h3>
                                        <?= htmlspecialchars($vac['titulo']) ?>
                                    </h3>

                                    <p>
                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                $vac['descripcion'],
                                                0,
                                                120,
                                                '...'
                                            )
                                        ) ?>
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- FECHA -->
                        <td>

                            <span class="date-pill">

                                📅

                                <?= $vac['fechaPublicacion']
                                    ? date(
                                        "d/m/Y",
                                        strtotime($vac['fechaPublicacion'])
                                    )
                                    : '-' ?>

                            </span>

                        </td>

                        <!-- MODALIDAD -->
                        <td>

                            <div class="badges-group">

                                <span class="mini-badge badge-blue">

                                    <?= htmlspecialchars($vac['modalidad']) ?>

                                </span>

                                <span class="mini-badge badge-purple">

                                    <?= htmlspecialchars($vac['tipoContrato']) ?>

                                </span>

                            </div>

                        </td>

                        <!-- CANDIDATOS -->
                        <td>

                            <div class="candidate-counter">

                                <?= (int)$vac['candidatos'] ?>

                            </div>

                        </td>

                        <!-- ESTADO -->
                        <td>

                            <span class="status-badge <?= $badgeClass ?>">

                                <?= htmlspecialchars($vac['estatus']) ?>

                            </span>

                        </td>

                        <!-- ACCIONES -->
                        <td>

                            <div class="actions-grid">

                                <!-- CANDIDATOS -->
                                <button
                                    class="btn-action btn-blue"
                                    onclick="location.href='?cargar=CandidatosListView&id=<?= $vac['idVacante'] ?>'"
                                >
                                    👥
                                </button>

                                <!-- EDITAR -->
                                <button
                                    class="btn-action btn-orange"
                                    onclick="location.href='?cargar=VacantesEditView&id=<?= $vac['idVacante'] ?>'"
                                >
                                    ✏️
                                </button>

                                <!-- ESTADO -->
                                <button
                                    class="btn-action btn-yellow"
                                    onclick="confirmarEstado(
                                        <?= $vac['idVacante'] ?>,
                                        '<?= addslashes($vac['estatus']) ?>'
                                    )"
                                >
                                    ⏸️
                                </button>

                                <!-- ELIMINAR -->
                                <button
                                    class="btn-action btn-red"
                                    onclick="confirmarEliminacion(
                                        <?= $vac['idVacante'] ?>
                                    )"
                                >
                                    🗑️
                                </button>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📭
                            </div>

                            <h2>
                                No hay vacantes publicadas
                            </h2>

                            <p>
                                Comienza creando tu primera oportunidad laboral.
                            </p>

                            <a
                                href="?cargar=VacantesAddView"
                                class="btn-empty"
                            >
                                ➕ Crear Vacante
                            </a>

                        </div>

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</section>

</main>

<script>

function confirmarEliminacion(idVacante){

    if(confirm("¿Deseas eliminar esta vacante?")){

        window.location.href =
            "?cargar=EliminarVacanteAction&id="
            + idVacante;
    }
}

function confirmarEstado(idVacante, estadoActual){

    let siguiente = '';

    estadoActual = estadoActual.toLowerCase();

    if(estadoActual === 'abierta'){
        siguiente = 'Cerrada';
    }
    else if(estadoActual === 'cerrada'){
        siguiente = 'Abierta';
    }
    else{
        siguiente = 'Abierta';
    }

    if(confirm("Cambiar estado a: " + siguiente + " ?")){

        window.location.href =
            "?cargar=CambiarEstadoVacanteAction&id="
            + idVacante
            + "&nuevoEstado="
            + encodeURIComponent(siguiente);
    }
}

</script>