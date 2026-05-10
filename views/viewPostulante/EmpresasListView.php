<?php
require_once __DIR__ . '/../../usecase/Empresa/EmpresaController.php';
require_once __DIR__ . '/../../usecase/Lookup_Tables/EstadoValidacionEmpresa/EstadoValidacionEmpresaController.php';
require_once __DIR__ . '/../../usecase/Vacantes/VacanteController.php';

/* =========================
   VALIDACIONES
========================= */

$listarValidaciones = array();

$estadoValidacionEmpresaController =
new EstadoValidacionEmpresaController();

$resultValidaciones =
$estadoValidacionEmpresaController
->ListarValidacionesEmpresa();

if(strtolower($resultValidaciones->status) == "ok"){

    foreach($resultValidaciones->body as $estado){

        $listarValidaciones[
        $estado["idEstadoValidacionEmpresa"]
        ] = $estado["estadoValidacionEmpresa"];

    }

}

/* =========================
   EMPRESAS
========================= */

$controller = new EmpresaController();

$listar = array();

$resultEmpresas =
$controller->listarEmpresas();

if(strtolower($resultEmpresas->status) == "ok"){

    $listar = $resultEmpresas->body;

}

/* =========================
   VACANTES
========================= */

$vacanteController =
new VacanteController();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Klivify | Gestión de Empresas
    </title>

    <!-- CSS -->
    <link
    rel="stylesheet"
    href="css/EmpresasListView.css">

    <!-- FONT AWESOME -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

<!-- =====================================
     HEADER
===================================== -->

<header class="header">

    <div class="header-content">

        <div class="header-text">

            <h1>
                🚀 Gestión Inteligente de Empresas
            </h1>

            <p>
                Administra compañías, vacantes y conexiones
                empresariales con una experiencia UIX moderna.
            </p>

        </div>

        <div class="header-actions">

            <a
            href="agregar-empresa.php"
            class="btn-add">

                <i class="fa-solid fa-plus"></i>

                Registrar Empresa

            </a>

        </div>

    </div>

</header>

<!-- =====================================
     MAIN
===================================== -->

<main class="container">

<!-- =====================================
     FILTROS
===================================== -->

<section class="filter-section">

    <div class="filter-header">

        <h2>
            🔍 Buscar Empresas
        </h2>

        <p>
            Filtra compañías registradas por nombre,
            sector o validación.
        </p>

    </div>

    <!-- FORM SIN ACTION -->
    <form class="filter-form" id="filterForm">

        <!-- NOMBRE -->

        <div class="filter-group">

            <label for="nombre">

                Nombre Empresa

            </label>

            <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Ej. TechVerse">

        </div>

        <!-- SECTOR -->

        <div class="filter-group">

            <label for="sector">

                Sector

            </label>

            <input
            type="text"
            id="sector"
            name="sector"
            placeholder="Tecnología, Salud...">

        </div>

        <!-- VALIDACION -->

        <div class="filter-group">

            <label for="validacion">

                Estado

            </label>

            <select
            id="validacion"
            name="validacion">

                <option value="">
                    Todos
                </option>

                <?php foreach($listarValidaciones as $id => $nombre): ?>

                <option value="<?php echo $id; ?>">

                    <?php echo htmlspecialchars($nombre); ?>

                </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- BOTONES -->

        <div class="filter-actions">

            <button
            type="button"
            class="btn-filter">

                <i class="fa-solid fa-magnifying-glass"></i>

                Buscar

            </button>

            <button
            type="reset"
            class="btn-clear"
            id="btnClear">

                <i class="fa-solid fa-rotate-left"></i>

                Limpiar

            </button>

        </div>

    </form>

</section>

<!-- =====================================
     GRID EMPRESAS
===================================== -->

<section
class="companies-grid"
id="companiesGrid">

<!-- =====================================
     EMPRESAS REALES
===================================== -->

<?php if (count($listar) > 0): ?>

<?php
$currentDate = date('Y-m-d');
?>

<?php foreach ($listar as $empresa): ?>

<?php

$resultVacantes =
$vacanteController
->ListarVacantesPorEmpresa(
$empresa['idEmpresas']
);

$countVacantes = 0;
$countAbiertas = 0;

if (
isset($resultVacantes->status)
&&
strtolower($resultVacantes->status) == "ok"
&&
is_array($resultVacantes->body)
){

    $countVacantes =
    count($resultVacantes->body);

    foreach(
    $resultVacantes->body
    as $vacante
    ){

        if(
        isset($vacante['fechaLimite'])
        &&
        $vacante['fechaLimite']
        >=
        $currentDate
        ){

            $countAbiertas++;

        }

    }

}

?>

<div
class="company-card"

data-nombre="<?php echo htmlspecialchars(strtolower($empresa['nombreEmpresa'])); ?>"

data-sector="<?php echo htmlspecialchars(strtolower($empresa['sector'])); ?>"

data-validacion="<?php echo $empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']; ?>">

    <!-- TOP -->

    <div class="company-top">

        <div class="company-logo">

            <i class="fa-solid fa-building"></i>

        </div>

        <?php

        $estado =
        intval(
        $empresa['EstadoValidacionEmpresa_idEstadoValidacionEmpresa']
        );

        $estados = [
            "",
            "✓ Validada",
            "⏳ Pendiente",
            "✗ Rechazada"
        ];

        $clasesEstado = [
            "",
            "status-validada",
            "status-pendiente",
            "status-rechazada"
        ];

        $textoEstado =
        isset($estados[$estado])
        ?
        $estados[$estado]
        :
        "Desconocido";

        $claseEstado =
        isset($clasesEstado[$estado])
        ?
        $clasesEstado[$estado]
        :
        "";

        ?>

        <span
        class="validation-status <?php echo $claseEstado; ?>">

            <?php echo $textoEstado; ?>

        </span>

    </div>

    <!-- CONTENT -->

    <div class="company-content">

        <h3>

            <?php
            echo htmlspecialchars(
            $empresa['nombreEmpresa']
            );
            ?>

        </h3>

        <span class="company-sector">

            <?php
            echo htmlspecialchars(
            $empresa['sector']
            );
            ?>

        </span>

        <p class="company-description">

            <?php
            echo htmlspecialchars(
            $empresa['descripcion']
            );
            ?>

        </p>

    </div>

    <!-- STATS -->

    <div class="company-stats">

        <div class="stat-box">

            <h4>

                <?php echo $countVacantes; ?>

            </h4>

            <p>
                Vacantes
            </p>

        </div>

        <div class="stat-box">

            <h4>

                <?php echo $countAbiertas; ?>

            </h4>

            <p>
                Abiertas
            </p>

        </div>

    </div>

    <!-- ACTIONS -->

    <div class="company-actions">

        <a
        href="perfil-empresa.php?id=<?php echo $empresa['idEmpresas']; ?>"
        class="btn-profile">

            <i class="fa-solid fa-eye"></i>

            Perfil

        </a>

        <a
        href="vacantes-empresa.php?idEmpresa=<?php echo $empresa['idEmpresas']; ?>"
        class="btn-vacancies">

            <i class="fa-solid fa-briefcase"></i>

            Vacantes

        </a>

    </div>

</div>

<?php endforeach; ?>

<?php endif; ?>

</section>

</main>

<!-- =====================================
     FILTROS JS EN TIEMPO REAL
===================================== -->

<script>

document.addEventListener('DOMContentLoaded', () => {

    const inputNombre =
    document.getElementById('nombre');

    const inputSector =
    document.getElementById('sector');

    const selectValidacion =
    document.getElementById('validacion');

    const btnClear =
    document.getElementById('btnClear');

    const cards =
    document.querySelectorAll('.company-card');

    function filtrarEmpresas(){

        const nombre =
        inputNombre.value.toLowerCase();

        const sector =
        inputSector.value.toLowerCase();

        const validacion =
        selectValidacion.value;

        cards.forEach(card => {

            const cardNombre =
            card.dataset.nombre || '';

            const cardSector =
            card.dataset.sector || '';

            const cardValidacion =
            card.dataset.validacion || '';

            const coincideNombre =
            cardNombre.includes(nombre);

            const coincideSector =
            cardSector.includes(sector);

            const coincideValidacion =
            validacion === ''
            ||
            cardValidacion === validacion;

            if(
                coincideNombre
                &&
                coincideSector
                &&
                coincideValidacion
            ){

                card.style.display = 'block';

            }else{

                card.style.display = 'none';

            }

        });

    }

    inputNombre.addEventListener(
    'input',
    filtrarEmpresas
    );

    inputSector.addEventListener(
    'input',
    filtrarEmpresas
    );

    selectValidacion.addEventListener(
    'change',
    filtrarEmpresas
    );

    btnClear.addEventListener('click', () => {

        setTimeout(() => {

            cards.forEach(card => {

                card.style.display = 'block';

            });

        }, 50);

    });

});

</script>

</body>
</html>