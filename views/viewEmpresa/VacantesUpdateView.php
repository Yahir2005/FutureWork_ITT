<?php
// Vista: VacantesUpdateView
// Ubicación esperada: views/viewEmpresa/VacantesUpdateView.php
//
// Propósito:
// - Mostrar un formulario para editar una vacante existente.
// - Prellenar los campos consultando las vacantes disponibles (temporalmente se usa ListarVacantes y se filtra por id).
// - Enviar el formulario a una acción que procese la actualización (ej. ?cargar=VacantesUpdateAction&id=...).
//
// Notas de integración:
// - Se recomienda crear en el controlador/gateway un método ListarVacantePorId($id) para obtener la vacante directamente.
// - La acción que procesa el POST (VacantesUpdateAction) debe llamar a VacanteController->ActualizarVacante($id, $vacanteObject).
// - Las listas de estados, tipos de contrato y modalidades idealmente deben provenir de la DB; aquí incluyo ejemplos y comentarios
//   para cargar dinámicamente esos select desde el gateway o desde el controlador.

require_once __DIR__ . "/../../usecase/Usuario/SessionManager.php";
require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";

if(!SessionManager::isUserLoggedIn()){
    header("Location: ../index.php");
    exit;
}

// Obtener id por GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$vacanteDatos = null;

// Intentar obtener la vacante desde el controlador (no hay ListarVacantePorId; se obtiene todo y se filtra)
$controller = new VacanteController();
$response = $controller->ListarVacantes();

if($response && property_exists($response, 'body') && is_array($response->body)){
    foreach($response->body as $v){
        // Dependiendo de la forma en que ListarVacantes devuelva los campos, 'idVacante' es el nombre esperado
        if(isset($v['idVacante']) && intval($v['idVacante']) === $id){
            $vacanteDatos = $v;
            break;
        }
    }
}

// Datos de ejemplo si no se encontró (para diseño). Eliminar cuando esté conectado al gateway correctamente.
if($vacanteDatos === null){
    $vacanteDatos = [
        'idVacante' => $id ?: 0,
        'Empresa_idEmpresa' => 1,
        'EstadoValidacionVacante_idEstadoValidacionVacante' => 1,
        'TipoContrato_idTipoContrato' => 1,
        'TipoModalidad_idTipoModalidad' => 2,
        'titulo' => 'Desarrollador PHP / Laravel (Ejemplo)',
        'descripcion' => 'Descripción de ejemplo. Reemplaza con datos reales al integrar.',
        'requisitos' => "PHP, Laravel, MySQL",
        'ubicacion' => 'Tehuacán, Puebla',
        'salario' => '15000.00',
        'fechaLimite' => date('Y-m-d', strtotime('+30 days'))
    ];
}

// Función auxiliar para marcar selected en selects
function selected($a, $b){
    return ((string)$a === (string)$b) ? 'selected' : '';
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FutureWork ITT - Editar Vacante</title>
  <link rel="stylesheet" href="css/VacantesAddView.css">
  <style>@view-transition { navigation: auto; }</style>
</head>
<body>
  <?php include_once __DIR__ . "/navbarEmpresa.php"; ?>
  <main class="container" style="max-width:1100px; margin:30px auto;">
    <header class="header" style="border-radius:12px 12px 0 0; padding:20px 30px;">
      <div class="header-content">
        <h1>✏️ Editar Vacante</h1>
        <p>Modifica la información de tu publicación. Recuerda guardar los cambios.</p>
      </div>
    </header>

    <form method="POST" action="?cargar=VacantesUpdateAction&id=<?php echo htmlspecialchars($vacanteDatos['idVacante']); ?>" style="background:white; padding:24px; border-radius:0 0 12px 12px; box-shadow:0 2px 10px rgba(0,0,0,0.04);">
      <!-- Mensajes de estado (opcional) -->
      <?php if(isset($_GET['status']) && $_GET['status'] === 'ok'): ?>
        <div class="alert alert-success" style="margin-bottom:16px;">✓ Vacante actualizada exitosamente</div>
      <?php elseif(isset($_GET['status']) && $_GET['status'] === 'error'): ?>
        <div class="alert alert-error" style="margin-bottom:16px;">✗ Ocurrió un error al actualizar la vacante</div>
      <?php endif; ?>

      <div class="form-section">
        <h3 class="section-title">📋 Información Básica</h3>
        <div class="form-grid">
          <div class="form-group form-group-full">
            <label for="titulo">Título de la Vacante <span class="required">*</span></label>
            <input type="text" id="titulo" name="titulo" required value="<?php echo htmlspecialchars($vacanteDatos['titulo'] ?? ''); ?>" placeholder="Ej: Desarrollador Backend Senior">
          </div>

          <div class="form-group form-group-full">
            <label for="descripcion">Descripción <span class="required">*</span></label>
            <textarea id="descripcion" name="descripcion" required placeholder="Descripción detallada"><?php echo htmlspecialchars($vacanteDatos['descripcion'] ?? ''); ?></textarea>
          </div>

          <div class="form-group">
            <label for="ubicacion">Ubicación <span class="required">*</span></label>
            <input type="text" id="ubicacion" name="ubicacion" required value="<?php echo htmlspecialchars($vacanteDatos['ubicacion'] ?? ''); ?>" placeholder="Ej: Tehuacán, Puebla">
          </div>

          <div class="form-group">
            <label for="salario">Salario Mensual</label>
            <input type="number" id="salario" name="salario" min="0" step="0.01" value="<?php echo htmlspecialchars($vacanteDatos['salario'] ?? ''); ?>" placeholder="Ej: 15000.00">
            <span class="input-hint">Opcional</span>
          </div>

          <div class="form-group">
            <label for="fechaLimite">Fecha límite de postulación</label>
            <input type="date" id="fechaLimite" name="fechaLimite" value="<?php echo htmlspecialchars(isset($vacanteDatos['fechaLimite']) ? date('Y-m-d', strtotime($vacanteDatos['fechaLimite'])) : ''); ?>">
            <span class="input-hint">Opcional</span>
          </div>

          <div class="form-group">
            <label for="idEmpresa">ID de Empresa <span class="required">*</span></label>
            <input type="number" id="idEmpresa" name="Empresa_idEmpresa" required value="<?php echo htmlspecialchars($vacanteDatos['Empresa_idEmpresa'] ?? ''); ?>">
            <span class="input-hint">El ID de la empresa suele venir desde la sesión; considera ocultarlo y asignarlo en el backend.</span>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="section-title">💼 Detalles del Contrato</h3>
        <div class="form-grid">
          <div class="form-group">
            <label for="idEstadoValidacionVacante">Estado de la Vacante <span class="required">*</span></label>
            <select id="idEstadoValidacionVacante" name="EstadoValidacionVacante_idEstadoValidacionVacante" required>
              <!-- Ejemplos; idealmente cargar desde DB -->
              <option value="1" <?php echo selected($vacanteDatos['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? '', 1); ?>>Abierta</option>
              <option value="2" <?php echo selected($vacanteDatos['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? '', 2); ?>>Cerrada</option>
              <option value="3" <?php echo selected($vacanteDatos['EstadoValidacionVacante_idEstadoValidacionVacante'] ?? '', 3); ?>>Pausada</option>
            </select>
          </div>

          <div class="form-group">
            <label for="idTipoContrato">Tipo de Contrato <span class="required">*</span></label>
            <select id="idTipoContrato" name="TipoContrato_idTipoContrato" required>
              <!-- Ejemplos; idealmente cargar desde DB -->
              <option value="1" <?php echo selected($vacanteDatos['TipoContrato_idTipoContrato'] ?? '', 1); ?>>Tiempo Completo</option>
              <option value="2" <?php echo selected($vacanteDatos['TipoContrato_idTipoContrato'] ?? '', 2); ?>>Medio Tiempo</option>
              <option value="3" <?php echo selected($vacanteDatos['TipoContrato_idTipoContrato'] ?? '', 3); ?>>Por Proyecto</option>
              <option value="4" <?php echo selected($vacanteDatos['TipoContrato_idTipoContrato'] ?? '', 4); ?>>Pasantía</option>
            </select>
          </div>

          <div class="form-group">
            <label for="idTipoModalidad">Modalidad de Trabajo <span class="required">*</span></label>
            <select id="idTipoModalidad" name="TipoModalidad_idTipoModalidad" required>
              <!-- Ejemplos; idealmente cargar desde DB -->
              <option value="1" <?php echo selected($vacanteDatos['TipoModalidad_idTipoModalidad'] ?? '', 1); ?>>Presencial</option>
              <option value="2" <?php echo selected($vacanteDatos['TipoModalidad_idTipoModalidad'] ?? '', 2); ?>>Remoto</option>
              <option value="3" <?php echo selected($vacanteDatos['TipoModalidad_idTipoModalidad'] ?? '', 3); ?>>Híbrido</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="section-title">🎯 Requisitos</h3>
        <div class="form-grid">
          <div class="form-group form-group-full">
            <label for="requisitos">Requisitos y habilidades</label>
            <textarea id="requisitos" name="requisitos" placeholder="Lista los requisitos, habilidades técnicas, años de experiencia..."><?php echo htmlspecialchars($vacanteDatos['requisitos'] ?? ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="form-actions" style="display:flex; gap:12px;">
        <button type="submit" class="btn-submit">💾 Guardar cambios</button>
        <a href="?cargar=MisVacantesListView" class="btn-cancel" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">✖ Cancelar</a>
      </div>
    </form>
  </main>

<script>
  // Validación ligera antes de enviar el formulario
  document.querySelector('form').addEventListener('submit', function(e){
    const titulo = document.getElementById('titulo').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();
    if(!titulo || !descripcion){
      e.preventDefault();
      alert('Por favor completa el título y la descripción antes de guardar.');
      return false;
    }
    // opcional: mostrar confirmación
    if(!confirm('¿Deseas guardar los cambios en esta vacante?')) {
      e.preventDefault();
      return false;
    }
  });
</script>
</body>
</html>