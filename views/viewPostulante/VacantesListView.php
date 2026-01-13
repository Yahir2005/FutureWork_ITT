<?php
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

$vacanteController = new VacanteController();

/**Contar total de vacantes */
$totalVacantes = $vacanteController->contarVacantes();
$totalVacantesAbiertas = $vacanteController->contarVacantesAbiertas();
$totalVacantesCerradas = $vacanteController->contarVacantesCerradas();
$totalVacantesPausadas = $vacanteController->contarVacantesPausadas();




// --- Empresas ---
$listarVacantesCard = array();
$resultVacantes = $vacanteController->ListarVacantesTotalesCard() ;
if(strtolower($resultVacantes->status) == "ok"){
  $listarVacantesCard = $resultVacantes->body;
}




/**Controladores */
/*
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
*/
/**Arrays*/
/*
$listarVacantes = array(); // Aquí se almacenarán las vacantes obtenidas
$listarEmpresa = array(); // Aquí se almacenará la información de la empresa
$listarValidacionVacante = array();
$listarTipoContrato = array();
$listarTipoModalidad = array();*/

/**Contadores */
/*
$totalVacantes = 0;
$totalAbiertas = 0;
$totalCerradas = 0;
$totalPausadas = 0;*/

/**Instancias */
/*
$vacanteController = new VacanteController();
$empresaController = new EmpresaController();
$vacanteValidacionController = new EstadoValidacionVacanteController();
$TipoContratoController = new TipoContratoController();
$TipoModalidadController = new TipoModalidadController();*/

/**Listar */
/*
if($resultListarValidacionVacante->status == "OK"){
  $listarValidacionVacante = $resultListarValidacionVacante->body;
}
if($resultListarTipoContrato->status == "Ok"){
  $listarTipoContrato = $resultListarTipoContrato->body;
}

if($resultListarTipoModalidad->status == "ok"){
  $listarTipoModalidad = $resultListarTipoModalidad->body;
}
if ($resultVacantes && $resultVacantes->status == "ok" && is_array($resultVacantes->body)) {
  $listarVacantes = $resultVacantes->body;
  $totalVacantes = count($listarVacantes);

  foreach ($listarVacantes as $vacante) {
      // Estado de la vacante: campo EstadoValidacionVacante_idEstadoValidacionVacante
      switch ($vacante['EstadoValidacionVacante_idEstadoValidacionVacante']) {
          case 1: // Abierta
              $totalAbiertas++;
              break;
          case 2: // Cerrada
              $totalCerradas++;
              break;
          case 3: // Pausada
              $totalPausadas++;
              break;
      }
  }
}

$vacanteController = new VacanteController();
$empresaController = new EmpresaController();
*/
// 1. Obtener ID de la empresa de la URL
/*
$idEmpresa = $_GET['idEmpresa'] ?? null;
$nombreEmpresa = "Empresa no encontrada";
*/
/*if ($idEmpresa) {
    $resEmpresa = $empresaController->obtenerEmpresaPorId($idEmpresa);
   if(strtolower($resEmpresa->status()) == "ok") {
        // Ajusta 'nombreEmpresa' según el nombre real en tu base de datos
        $nombreEmpresa = $resEmpresa->body['nombreEmpresa'] ?? "Nombre de Empresa";
    }
}*/
// 2. Carga inicial de vacantes
/*
$listar = [];
$resultVacantes = $vacanteController->listarVacantesPorEmpresa($idEmpresa);
if(strtolower($resultVacantes->status) == "ok"){
    $listar = $resultVacantes->body;
}

// 3. Lógica de Filtros (Estilo de tu compañero)
if (isset($_GET["titulo"]) || isset($_GET["estado"]) || isset($_GET["modalidad"])) {
    $titulo = trim($_GET["titulo"] ?? "");
    $estado = trim($_GET["estado"] ?? "");
    $modalidad = trim($_GET["modalidad"] ?? "");

    $filtrado = $listar;

    if (!empty($titulo)) {
        $filtrado = array_filter($filtrado, function ($v) use ($titulo) {
            return stripos($v["tituloVacante"], $titulo) !== false;
        });
    }
    if (!empty($estado)) {
        $filtrado = array_filter($filtrado, function ($v) use ($estado) {
            return $v["idEstadoVacante"] == $estado;
        });
    }
    if (!empty($modalidad)) {
        $filtrado = array_filter($filtrado, function ($v) use ($modalidad) {
            return $v["idModalidad"] == $modalidad;
        });
    }
    $listar = array_values($filtrado);
}
*/
// 4. Estadísticas
/*
$totalVacantes = count($listar);
$abiertas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 1));
$cerradas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 2));
$pausadas = count(array_filter($listar, fn($v) => ($v['idEstadoVacante'] ?? 0) == 3));
*/
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Vacantes de Empresa</title>
  <link rel="stylesheet" href="css/VacantesListView.css">
  <style>
    @view-transition {
      navigation: auto;
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content"><!-- Stats Cards -->
    <div class="stats-container">
     <div class="stat-card">
      <div class="stat-label">
       📊 Total de Vacantes
      </div>
      <div class="stat-value">
       24
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ✅ Vacantes Abiertas
      </div>
      <div class="stat-value">
       18
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ❌ Vacantes Cerradas
      </div>
      <div class="stat-value">
       4
      </div>
     </div>
     <div class="stat-card">
      <div class="stat-label">
       ⏸️ Vacantes Pausadas
      </div>
      <div class="stat-value">
       2
      </div>
     </div>
    </div>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Vacancy Card 1 -->
   <div class="vacancies-grid">
    <div class="vacancy-card">
     <div class="vacancy-header">
      <div class="vacancy-title">
       <h3>Desarrollador Full Stack</h3>
       <div class="vacancy-id">
        ID: 101
       </div>
      </div><span class="tag contract">Abierta</span>
     </div>
     <div class="vacancy-details">
      <div class="detail-item">
       📍 Ubicación: Ciudad de México
      </div>
      <div class="detail-item">
       💰 Salario: $ 25,000 - 35,000
      </div>
      <div class="detail-item">
       📅 Límite: 2024-02-15
      </div>
     </div>
     <p class="vacancy-description">Buscamos un desarrollador full stack con experiencia en tecnologías modernas. Únete a nuestro equipo y trabaja en proyectos innovadores que impactan a miles de usuarios.</p>
     <div class="vacancy-footer">
      <div class="detail-item">
       * Requisitos: <br>
       3+ años de experiencia, JavaScript, React, Node.js, bases de datos SQL/NoSQL
      </div>
     </div><br>
     <div class="vacancy-tags"><span class="tag contract">Tiempo Completo</span> <span class="tag modality">Híbrido</span> <span class="tag salary">$ 25,000 - 35,000</span>
     </div>
     <div class="vacancy-footer">
      <div class="posted-date">
       📅 Publicado: 2024-01-15
      </div><a href="postular-vacante.php?idVacante=101" class="btn-postular"> ✅ Postularme </a>
     </div>
    </div>
   </div><!-- Vacancy Card 2 -->
   <div class="vacancies-grid">
    <div class="vacancy-card">
     <div class="vacancy-header">
      <div class="vacancy-title">
       <h3>Diseñador UX/UI</h3>
       <div class="vacancy-id">
        ID: 102
       </div>
      </div><span class="tag contract">Abierta</span>
     </div>
     <div class="vacancy-details">
      <div class="detail-item">
       📍 Ubicación: Guadalajara
      </div>
      <div class="detail-item">
       💰 Salario: $ 20,000 - 28,000
      </div>
      <div class="detail-item">
       📅 Límite: 2024-02-20
      </div>
     </div>
     <p class="vacancy-description">Buscamos un diseñador creativo con pasión por crear experiencias de usuario excepcionales. Trabaja con un equipo multidisciplinario en proyectos de alto impacto.</p>
     <div class="vacancy-footer">
      <div class="detail-item">
       * Requisitos: <br>
       2+ años de experiencia, Figma, Adobe XD, prototipado, investigación de usuarios
      </div>
     </div><br>
     <div class="vacancy-tags"><span class="tag contract">Tiempo Completo</span> <span class="tag modality">Remoto</span> <span class="tag salary">$ 20,000 - 28,000</span>
     </div>
     <div class="vacancy-footer">
      <div class="posted-date">
       📅 Publicado: 2024-01-18
      </div><a href="postular-vacante.php?idVacante=102" class="btn-postular"> ✅ Postularme </a>
     </div>
    </div>
   </div><!-- Vacancy Card 3 -->
   <div class="vacancies-grid">
    <div class="vacancy-card">
     <div class="vacancy-header">
      <div class="vacancy-title">
       <h3>Ingeniero DevOps</h3>
       <div class="vacancy-id">
        ID: 103
       </div>
      </div><span class="tag contract">Abierta</span>
     </div>
     <div class="vacancy-details">
      <div class="detail-item">
       📍 Ubicación: Monterrey
      </div>
      <div class="detail-item">
       💰 Salario: $ 30,000 - 40,000
      </div>
      <div class="detail-item">
       📅 Límite: 2024-02-25
      </div>
     </div>
     <p class="vacancy-description">Únete como ingeniero DevOps y ayuda a optimizar nuestros procesos de desarrollo. Trabajo con tecnologías cloud y herramientas de automatización de vanguardia.</p>
     <div class="vacancy-footer">
      <div class="detail-item">
       * Requisitos: <br>
       4+ años de experiencia, AWS/Azure, Docker, Kubernetes, CI/CD, scripting
      </div>
     </div><br>
     <div class="vacancy-tags"><span class="tag contract">Tiempo Completo</span> <span class="tag modality">Presencial</span> <span class="tag salary">$ 30,000 - 40,000</span>
     </div>
     <div class="vacancy-footer">
      <div class="posted-date">
       📅 Publicado: 2024-01-20
      </div><a href="postular-vacante.php?idVacante=103" class="btn-postular"> ✅ Postularme </a>
     </div>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd23901d2f2f863',t:'MTc2ODI3OTMwMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>