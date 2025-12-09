<?php
$idEmpresa = $_GET['idEmpresas'] ?? null;

  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
  require_once __DIR__ . "/../../Dto/Vacantes.php";
  /*Arrays*/
  $listarValidacionVacante = array();
  $listarTipoContrato = array();
  $listarTipoModalidad = array();
  /*Controllers*/
  $vacanteController = new VacanteController();
  $vacanteValidacionController = new EstadoValidacionVacanteController();
  $TipoContratoController = new TipoContratoController();
  $TipoModalidadController = new TipoModalidadController();
  /*resultListar */
  $resultListarValidacionVacante = $vacanteValidacionController->listarEstadoValidacionVacante();
  $resultListarTipoContrato = $TipoContratoController->listarTipoContrato();
  $resultListarTipoModalidad = $TipoModalidadController->listarTipoModalidad();

  /**listar */
  if($resultListarValidacionVacante->status == "ok"){
    $listarValidacionVacante = $resultListarValidacionVacante->body;
  }
  if($resultListarTipoContrato->status == "ok"){
    $listarTipoContrato = $resultListarTipoContrato->body;
  }

  if($resultListarTipoModalidad->status == "ok"){
    $listarTipoModalidad = $resultListarTipoModalidad->body;
  }

  /**Insertar  */
  if(isset($_POST["registrarVacante"])){
    $vacanteObject = new Vacantes();
    $vacanteObject->set("Empresa_idEmpresa",$idEmpresa);
    $vacanteObject->set("EstadoValidacionVacante_idEstadoValidacionVacante",$_POST["idEstadoValidacionVacante"]);
    $vacanteObject->set("TipoContrato_idTipoContrato",$_POST["idTipoContrato"]);
    $vacanteObject->set("TipoModalidad_idTipoModalidad",$_POST["idTipoModalidad"]);
    $vacanteObject->set("titulo",$_POST["titulo"]);
    $vacanteObject->set("descripcion",$_POST["descripcion"]);
    $vacanteObject->set("requisitos",$_POST["requisitos"]);
    $vacanteObject->set("ubicacion",$_POST["ubicacion"]);
    $vacanteObject->set("salario",$_POST["salario"]);
    $vacanteObject->set("fechaLimite",$_POST["fechaLimite"]);
    $resultVacante = $vacanteController->InsertarVacante($vacanteObject);
  }
  
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Agregar Vacante</title>
    <link rel="stylesheet" href="css/VacantesAddView.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <h1>💼 Agregar Nueva Vacante</h1>
    <p>Publica una nueva oportunidad laboral para estudiantes y egresados del ITT</p>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Aquí irán los mensajes de éxito o error desde PHP --> <!-- 
    <div class="alert alert-success">
      ✓ ¡Vacante agregada exitosamente!
    </div>
    <div class="alert alert-error">
      ✗ Error al agregar la vacante. Por favor, verifica los datos.
    </div>
    -->
   <form method="POST" action=""><!-- Información Básica -->
    <div class="form-section">
     <h3 class="section-title">📋 Información Básica</h3>
     <div class="form-grid">
      <div class="form-group form-group-full"><label for="titulo">Título de la Vacante<span class="required">*</span></label> <input type="text" id="titulo" name="titulo" required placeholder="Ej: Desarrollador Full Stack Junior">
      </div>
      <div class="form-group form-group-full"><label for="descripcion">Descripción de la Vacante<span class="required">*</span></label> <textarea id="descripcion" name="descripcion" required placeholder="Describe las responsabilidades, funciones y beneficios del puesto..."></textarea>
      </div>
      <div class="form-group"><label for="ubicacion">Ubicación<span class="required">*</span></label> <input type="text" id="ubicacion" name="ubicacion" required placeholder="Ej: Tehuacán, Puebla">
      </div>
      <div class="form-group"><label for="salario">Salario Mensual</label> <input type="number" id="salario" name="salario" min="0" step="0.01" placeholder="Ej: 15000.00"> <span class="input-hint">Opcional - Salario en pesos mexicanos</span>
      </div>
      <div class="form-group"><label for="fechaLimite">Fecha Límite de Postulación</label> <input type="date" id="fechaLimite" name="fechaLimite"> <span class="input-hint">Opcional - Fecha límite para recibir postulaciones</span>
      </div>
      <div class="form-group"><label for="idEmpresa">ID de Empresa<span class="required">*</span></label> <input type="number" id="idEmpresa" name="idEmpresa" required placeholder="ID de la empresa"> <span class="input-hint">Identificador de la empresa que publica la vacante</span>
      </div>
     </div>
    </div><!-- Detalles del Contrato -->
    <div class="form-section">
     <h3 class="section-title">💼 Detalles del Contrato</h3>
     <div class="form-grid">
     
     <!-- Estado de la Vacante -->
        <div class="form-group">
          <label for="idEstadoValidacionVacante">Estado de la Vacante<span class="required">*</span></label>
          <select id="idEstadoValidacionVacante" name="idEstadoValidacionVacante" required>
            <option value="">Selecciona el estado</option>
            <?php foreach($listarValidacionVacante as $item): ?>
              <option value="<?= $item['idEstadoValidacionVacante'] ?>">
                <?= $item['estadoValidacionVacante'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

      <!-- Tipo de Contrato -->
      <div class="form-group">
        <label for="idTipoContrato">Tipo de Contrato<span class="required">*</span></label>
        <select id="idTipoContrato" name="idTipoContrato" required>
          <option value="">Selecciona el tipo de contrato</option>
          <?php foreach($listarTipoContrato as $tipo): ?>
            <option value="<?= $tipo['idTipoContrato'] ?>">
              <?= $tipo['estadoContrato'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Modalidad de Trabajo -->
      <div class="form-group">
        <label for="idTipoModalidad">Modalidad de Trabajo<span class="required">*</span></label>
        <select id="idTipoModalidad" name="idTipoModalidad" required>
          <option value="">Selecciona la modalidad</option>
          <?php foreach($listarTipoModalidad as $modalidad): ?>
            <option value="<?= $modalidad['idTipoModalidad'] ?>">
              <?= $modalidad['tipoModalidad'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

     </div>
    </div><!-- Requisitos -->
    <div class="form-section">
     <h3 class="section-title">🎓 Requisitos y Habilidades</h3>
     <div class="form-grid">
      <div class="form-group form-group-full"><label for="requisitos">Requisitos del Puesto</label> <textarea id="requisitos" name="requisitos" placeholder="Lista los requisitos, habilidades técnicas, conocimientos y experiencia necesaria para el puesto..."></textarea> <span class="input-hint">Opcional - Describe los requisitos académicos, técnicos y de experiencia</span>
      </div>
     </div>
    </div><!-- Form Actions -->
    <div class="form-actions"><button type="submit" name = class="btn-submit">💼 Publicar Vacante</button> <a href="vacantes.php" class="btn-cancel">✖ Cancelar</a>
    </div>
   </form>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a0d230292e8b1f2',t:'MTc2MzUyODM1MS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>