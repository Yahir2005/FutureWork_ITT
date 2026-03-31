<?php

    $MessageID = "";
    require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
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
    $usuarioController = new UsuarioController();
    $vacanteController = new VacanteController();
    $vacanteValidacionController = new EstadoValidacionVacanteController();
    $TipoContratoController = new TipoContratoController();
    $TipoModalidadController = new TipoModalidadController();
    
    /*resultListar */
    $resultListarValidacionVacante = $vacanteValidacionController->listarEstadoValidacionVacante();
    $resultListarTipoContrato = $TipoContratoController->listarTipoContrato();
    $resultListarTipoModalidad = $TipoModalidadController->listarTipoModalidad();

    /**listar (Estandarizado a minúsculas para evitar errores de case) */
    if($resultListarValidacionVacante->status == "OK"){
        $listarValidacionVacante = $resultListarValidacionVacante->body;
    }
    if($resultListarTipoContrato->status == "Ok"){
        $listarTipoContrato = $resultListarTipoContrato->body;
    }
    if($resultListarTipoModalidad->status == "ok"){
        $listarTipoModalidad = $resultListarTipoModalidad->body;
    }

    /**Extraer el ID de la empresa*/
    $idUsuario = $_SESSION["idUsuarios"];
  
    /**Insertar  */
    if(isset($_POST["registrarVacante"])){
        $result = $usuarioController->obtenerEntidadPorUsuario($idUsuario);
        $datos = $result->body;
        $idEmpresa = $datos['empresaId'];
        
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

        if (strtolower($resultVacante->status) == 'ok') {
            echo "<div class='alert alert-success' role='alert'>✓ Registro exitoso</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>✗ Error al registrar: ".$resultVacante->message."</div>";
        }
    }
?>

<div class="p-5">
  <!-- Formulario único consolidado -->
   
  <form method="POST" action="" class="row g-3 needs-validation" novalidate>
     <?php echo $MessageID; ?>
    <h3 class="section-title w-100">📋 Información Básica</h3>
    
    <div class="col-md-6">
      <label for="titulo" class="form-label">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Desarrollador Full Stack Junior"  required>
    </div>

    <div class="col-md-6">
      <label for="ubicacion" class="form-label">Ubicación</label>
      <input type="text" class="form-control" 
      id="ubicacion" 
      name="ubicacion" 
      placeholder="Ej: Tehuacán, Puebla" required>
    </div>

    <div class="col-md-6">
      <label for="salario" class="form-label">Salario</label>
      <input type="number" step="0.01" 
      class="form-control" 
      id="salario" 
      name="salario" 
      placeholder="Ej. 15000" required>
    </div>

    <div class="col-md-6">
      <label for="fechaLimite" class="form-label">Fecha Límite</label>
      <input type="date" class="form-control" id="fechaLimite" name="fechaLimite" required>
    </div>

    <div class="col-md-12">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea class="form-control" id="descripcion" 
      name="descripcion" 
      placeholder="Describe las responsabilidades, funciones y beneficios del puesto..." 
      rows="3" required></textarea>
    </div>

    <h3 class="section-title w-100 mt-4">💼 Detalles del Contrato</h3>
    
    <div class="col-md-4">
      <label for="idEstadoValidacionVacante" class="form-label">Estado de la Vacante <span class="text-danger">*</span></label>
      <select class="form-select" id="idEstadoValidacionVacante" name="idEstadoValidacionVacante" required>
        <option value="">Selecciona el estado</option>
        <?php foreach($listarValidacionVacante as $item): ?>
          <option value="<?= $item['idEstadoValidacionVacante'] ?>">
            <?= $item['estadoValidacionVacante'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label for="idTipoContrato" class="form-label">Tipo de Contrato <span class="text-danger">*</span></label>
      <select class="form-select" id="idTipoContrato" name="idTipoContrato" required>
        <option value="">Selecciona el contrato</option>
        <?php foreach($listarTipoContrato as $tipo): ?>
          <option value="<?= $tipo['idTipoContrato'] ?>">
            <?= $tipo['estadoContrato'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label for="idTipoModalidad" class="form-label">Modalidad <span class="text-danger">*</span></label>
      <select class="form-select" id="idTipoModalidad" name="idTipoModalidad" required>
        <option value="">Selecciona la modalidad</option>
        <?php foreach($listarTipoModalidad as $modalidad): ?>
          <option value="<?= $modalidad['idTipoModalidad'] ?>">
            <?= $modalidad['tipoModalidad'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <h3 class="section-title w-100 mt-4">🎓 Requisitos</h3>
    <div class="col-md-12">
      <label for="requisitos" class="form-label">Requisitos</label>
      <textarea class="form-control" id="requisitos" 
      name="requisitos" 
      placeholder="Lista los requisitos, habilidades técnicas, conocimientos y experiencia necesaria para el puesto..."  
      rows="3" required>
    </textarea>
    </div>

    <div class="col-12 mt-4">
      <!-- Se añade name="registrarVacante" para disparar el if en PHP -->
      <button class="btn btn-primary" type="submit" name="registrarVacante">Guardar Vacante</button>
    </div>
  </form>
</div>