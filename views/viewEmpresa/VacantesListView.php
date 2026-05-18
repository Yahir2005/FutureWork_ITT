<?php
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

$vacanteController = new VacanteController();

/* =========================
   CONTADORES
========================= */
$totalVacantes = $vacanteController->contarVacantes();
$totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
$totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
$totalVacantesPausadas = $vacanteController->contarVacantesPausadas();

/* =========================
   LISTAR VACANTES
========================= */
$listarVacantesCard = array();

$resultVacantes = $vacanteController->ListarVacantesTotalesCard();

if(strtolower($resultVacantes->status) == "ok"){
    $listarVacantesCard = $resultVacantes->body;
}
?>

<!-- IMPORTANTE:
NO USES <!DOCTYPE html>, <html>, <head> NI <body>
porque esta vista YA se carga dentro del navbar/layout principal.
Eso era lo que rompía el navbar.
-->

<link rel="stylesheet" href="css/VacantesListView.css">

<main class="vacantes-page">

    <!-- HERO -->
    <section class="hero-section">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <div class="hero-text">

                <span class="hero-badge">
                    💼 Bolsa de Trabajo Profesional
                </span>

                <h1>
                    Explora las mejores vacantes
                </h1>

               
            </div>

            <div class="hero-stats-mini">

                <div class="mini-card">
                    <h3><?= $totalVacantes->body ?></h3>
                    <span>Vacantes</span>
                </div>

                <div class="mini-card">
                    <h3><?= $totalVacantesAbiertas->body ?></h3>
                    <span>Activas</span>
                </div>

            </div>

        </div>

        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

    </section>

    <!-- STATS -->
    <section class="stats-grid">

        <div class="stat-card stat-blue">
            <div class="stat-icon">📊</div>

            <div>
                <h2><?= $totalVacantes->body ?></h2>
                <p>Total de Vacantes</p>
            </div>
        </div>

        <div class="stat-card stat-green">
            <div class="stat-icon">✅</div>

            <div>
                <h2><?= $totalVacantesAbiertas->body ?></h2>
                <p>Vacantes Abiertas</p>
            </div>
        </div>

        <div class="stat-card stat-red">
            <div class="stat-icon">❌</div>

            <div>
                <h2><?= $totalVacantesCerradas->body ?></h2>
                <p>Vacantes Cerradas</p>
            </div>
        </div>

        <div class="stat-card stat-yellow">
            <div class="stat-icon">⏸️</div>

            <div>
                <h2><?= $totalVacantesPausadas->body ?></h2>
                <p>Vacantes Pausadas</p>
            </div>
        </div>

    </section>

    <!-- HEADER RESULTADOS -->
    <section class="results-header">

        <div>
            <h2>🚀 Vacantes Disponibles</h2>

            <p>
                <?= count($listarVacantesCard) ?> vacantes encontradas
            </p>
        </div>

        <div class="results-actions">

            <input
                type="text"
                placeholder="Buscar vacante..."
                class="search-input"
            >

        </div>

    </section>

    <!-- GRID VACANTES -->
    <?php if(count($listarVacantesCard) > 0): ?>

        <section class="vacancies-grid">

            <?php foreach($listarVacantesCard as $vacantes): ?>

                <article class="vacancy-card">

                    <div class="card-top">

                        <div class="vacancy-main">

                            <div class="company-icon">
                                💼
                            </div>

                            <div>

                                <h3>
                                    <?= htmlspecialchars($vacantes['titulo']); ?>
                                </h3>

                                <span class="vacancy-id">
                                    ID:
                                    <?= htmlspecialchars($vacantes['idVacante'] ?? 'N/A'); ?>
                                </span>

                            </div>

                        </div>

                        <span class="status-tag">
                            <?= htmlspecialchars($vacantes['estadoValidacionVacante']); ?>
                        </span>

                    </div>

                    <div class="vacancy-info">

                        <div class="info-item">
                            📍
                            <?= htmlspecialchars($vacantes['ubicacion']); ?>
                        </div>

                        <div class="info-item">
                            💰 $
                            <?= htmlspecialchars($vacantes['salario']); ?>
                        </div>

                        <div class="info-item">
                            📅
                            <?= htmlspecialchars($vacantes['fechaLimite']); ?>
                        </div>

                    </div>

                    <p class="vacancy-description">
                        <?= htmlspecialchars($vacantes['descripcion']); ?>
                    </p>

                    <div class="requirements-box">

                        <h4>
                            🎓 Requisitos
                        </h4>

                        <p>
                            <?= htmlspecialchars($vacantes['requisitos']); ?>
                        </p>

                    </div>

                    <div class="tags-container">

                        <span class="tag contract-tag">
                            <?= htmlspecialchars($vacantes['estadoContrato']); ?>
                        </span>

                        <span class="tag modality-tag">
                            <?= htmlspecialchars($vacantes['tipoModalidad']); ?>
                        </span>

                        <span class="tag salary-tag">
                            $ <?= htmlspecialchars($vacantes['salario']); ?>
                        </span>

                    </div>

                    <div class="card-footer">

                        <div class="publish-date">
                            🕒 Publicado:
                            <?= htmlspecialchars($vacantes['fechaPublicacion']); ?>
                        </div>

                        <a
                            href="?cargar=VacanteDetalle&id=<?= $vacantes['idVacante']; ?>"
                            class="btn-apply"
                        >
                            Ver Vacante →
                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </section>

    <?php else: ?>

        <!-- EMPTY -->
        <section class="empty-state">

            <div class="empty-icon">
                📭
            </div>

            <h2>
                No hay vacantes disponibles
            </h2>

            <p>
                Actualmente no existen vacantes registradas.
            </p>

        </section>

    <?php endif; ?>

</main>