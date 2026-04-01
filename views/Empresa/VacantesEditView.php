<?php
    $MessageID = "";
  // muestra el valor
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

    /**listar */
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
    $vacanteId= $_GET['id'];
    $vacante = [];
    $vacanteEditar= $vacanteController->obtenerVacanteporId($vacanteId);
    if($vacanteEditar->status == 'ok'){
        $vacante = $vacanteEditar->body[0];
    }else{
        echo $vacanteEditar->message;
    }


    /**Insertar  */
    if(isset($_POST["EditarVacante"])){
        $vacanteObject = new Vacantes();

        $vacanteObject->set("EstadoValidacionVacante_idEstadoValidacionVacante", $_POST["idEstadoValidacionVacante"]);
        $vacanteObject->set("TipoContrato_idTipoContrato", $_POST["idTipoContrato"]);
        $vacanteObject->set("TipoModalidad_idTipoModalidad", $_POST["idTipoModalidad"]);
        $vacanteObject->set("titulo", $_POST["titulo"]);
        $vacanteObject->set("descripcion", $_POST["descripcion"]);
        $vacanteObject->set("requisitos", $_POST["requisitos"]);
        $vacanteObject->set("ubicacion", $_POST["ubicacion"]);
        $vacanteObject->set("salario", $_POST["salario"]);
        $vacanteObject->set("fechaLimite", $_POST["fechaLimite"]);

        $resultVacante = $vacanteController->ActualizarVacante($vacanteId,$vacanteObject);

        if ($resultVacante->status == 'ok') {
            echo "<div class='alert alert-success' role='alert'>✓ Edicion exitoso</div>";
            $url_destino = 'http://localhost/FutureWork_ITT/views/viewEmpresa/navbarEmpresa.php?cargar=MisVacantesListView'; // Reemplaza esto con tu URL real

    // Especifica el retraso en segundos
    $retraso_segundos = 3;

    // Envía la cabecera de redirección meta refresh
    header("Refresh: $retraso_segundos; URL=$url_destino");
        } else {
            echo "<div class='alert alert-danger' role='alert'>✗ Error al editar: ".$resultVacante->message."</div>";
        }
    }
?>

<header class="bg-primary text-white py-4 mb-4 shadow-sm">
    <div class="container">
      <h1 class="h3 mb-1">💼 Editar Vacante</h1>
      <p class="mb-0">Actualiza la información de la oportunidad laboral para los estudiantes</p>
    </div>
  </header>

  <main class="container pb-5">
    
    <?php echo $alertaHTML; ?>

    <form method="POST" action="">
      
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="card-title border-bottom pb-2 mb-4">📋 Información Básica</h4>
          <div class="row g-3">
            
            <div class="col-md-12">
              <label for="titulo" class="form-label fw-bold">Título de la Vacante <span class="text-danger">*</span></label> 
              <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($vacante['titulo'] ?? ''); ?>" required>
            </div>

            <div class="col-md-12">
              <label for="descripcion" class="form-label fw-bold">Descripción de la Vacante <span class="text-danger">*</span></label> 
              <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($vacante['descripcion'] ?? ''); ?></textarea>
            </div>

            <div class="col-md-4">
              <label for="ubicacion" class="form-label fw-bold">Ubicación <span class="text-danger">*</span></label> 
              <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($vacante['ubicacion'] ?? ''); ?>" required>
            </div>

            <div class="col-md-4">
              <label for="salario" class="form-label fw-bold">Salario Mensual</label> 
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" id="salario" name="salario" min="0" step="0.01" value="<?php echo htmlspecialchars($vacante['salario'] ?? ''); ?>">
              </div>
              <div class="form-text">Opcional - Salario en pesos mexicanos</div>
            </div>

            <div class="col-md-4">
              <label for="fechaLimite" class="form-label fw-bold">Fecha Límite</label> 
              <input type="date" class="form-control" id="fechaLimite" name="fechaLimite" value="<?php echo htmlspecialchars($vacante['fechaLimite'] ?? ''); ?>">
              <div class="form-text">Opcional - Límite de postulaciones</div>
            </div>

          </div>
        </div>
      </div>

      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="card-title border-bottom pb-2 mb-4">💼 Detalles del Contrato</h4>
          <div class="row g-3">
            
            <div class="col-md-4">
              <label for="idEstadoValidacionVacante" class="form-label fw-bold">Estado de la Vacante <span class="text-danger">*</span></label>
              <select class="form-select" id="idEstadoValidacionVacante" name="idEstadoValidacionVacante" required>
                <option value="">Selecciona el estado</option>
                <?php foreach($listarValidacionVacante as $item): ?>
                  <?php $selected = ($item['idEstadoValidacionVacante'] == ($vacante['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? '')) ? 'selected' : ''; ?>
                  <option value="<?= htmlspecialchars($item['idEstadoValidacionVacante']) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($item['estadoValidacionVacante']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="idTipoContrato" class="form-label fw-bold">Tipo de Contrato <span class="text-danger">*</span></label>
              <select class="form-select" id="idTipoContrato" name="idTipoContrato" required>
                <option value="">Selecciona el contrato</option>
                <?php foreach($listarTipoContrato as $tipo): ?>
                  <?php $selected = ($tipo['idTipoContrato'] == ($vacante['TipoContrato_idTipoContrato'] ?? '')) ? 'selected' : ''; ?>
                  <option value="<?= htmlspecialchars($tipo['idTipoContrato']) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($tipo['estadoContrato']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="idTipoModalidad" class="form-label fw-bold">Modalidad de Trabajo <span class="text-danger">*</span></label>
              <select class="form-select" id="idTipoModalidad" name="idTipoModalidad" required>
                <option value="">Selecciona la modalidad</option>
                <?php foreach($listarTipoModalidad as $modalidad): ?>
                  <?php $selected = ($modalidad['idTipoModalidad'] == ($vacante['TipoModalidad_idTipoModalidad'] ?? '')) ? 'selected' : ''; ?>
                  <option value="<?= htmlspecialchars($modalidad['idTipoModalidad']) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($modalidad['tipoModalidad']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

          </div>
        </div>
      </div>

      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="card-title border-bottom pb-2 mb-4">🎓 Requisitos y Habilidades</h4>
          <div class="row g-3">
            <div class="col-md-12">
              <label for="requisitos" class="form-label fw-bold">Requisitos del Puesto</label> 
              <textarea class="form-control" id="requisitos" name="requisitos" rows="4"><?php echo htmlspecialchars($vacante['requisitos'] ?? ''); ?></textarea> 
              <div class="form-text">Opcional - Describe los requisitos académicos, técnicos y de experiencia</div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="?cargar=MisVacantesListView" class="btn btn-secondary px-4">✖ Cancelar</a>
        <button type="submit" name="EditarVacante" class="btn btn-primary px-4">💾 Guardar Cambios</button>
      </div>

    </form>
  </main>