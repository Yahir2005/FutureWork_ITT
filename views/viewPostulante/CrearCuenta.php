<?php
require_once __DIR__ . '/../../usecase/Postulantes/PostulantesController.php';
//require_once __DIR__ . '/../../usecase/Carrera/CarrerasController.php';
require_once __DIR__ . '/../../usecase/Lookup_Tables/Carrera/CarreraController.php';


session_start();

// -------- Usuario desde sesión --------
$idUsuario = $_SESSION['idUsuarios'] ?? null;

// -------- Carreras --------
//$carreraController = new CarreraController();
//$listarCarreras = [];
//$carreraController = new CarreraController();
//var_dump($carreraController);
$carreraController = new CarreraController();


$resultCarreras = $carreraController->listarCarrera();
if (isset($resultCarreras->status) && strtolower($resultCarreras->status) === "ok") {
    $listarCarreras = $resultCarreras->body;
}
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Crear Perfil de Postulante</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    html {
      height: 100%;
    }

    /* Main Container */
    .form-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 600px;
      width: 100%;
      overflow: hidden;
    }

    /* Header */
    .form-header {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      padding: 40px 30px;
      text-align: center;
    }

    .form-header h1 {
      font-size: 28px;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .form-header p {
      font-size: 15px;
      opacity: 0.95;
    }

    /* Form Body */
    .form-body {
      padding: 40px 30px;
    }

    /* Form Group */
    .form-group {
      margin-bottom: 25px;
    }

    .form-label {
      color: #2c3e50;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
    }

    .form-label .required {
      color: #dc3545;
      margin-left: 3px;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      font-size: 15px;
      color: #495057;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: all 0.3s ease;
      background: white;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-help {
      color: #6c757d;
      font-size: 13px;
      margin-top: 5px;
      display: block;
    }

    /* File Input */
    .file-input-wrapper {
      position: relative;
      width: 100%;
    }

    .file-input-label {
      display: block;
      width: 100%;
      padding: 12px 15px;
      border: 2px dashed #e9ecef;
      border-radius: 8px;
      background: #f8f9fa;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      color: #6c757d;
      font-size: 14px;
    }

    .file-input-label:hover {
      border-color: #667eea;
      background: #e9ecef;
    }

    .file-input-label.has-file {
      border-color: #28a745;
      background: #d4edda;
      color: #155724;
    }

    .file-input {
      display: none;
    }

    /* Button */
    .btn-submit {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:disabled {
      background: #6c757d;
      cursor: not-allowed;
      transform: none;
    }

    /* Success Message */
    .success-message {
      background: #d4edda;
      border: 2px solid #28a745;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      display: none;
      text-align: center;
    }

    .success-message.show {
      display: block;
    }

    .success-message h3 {
      color: #155724;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .success-message p {
      color: #155724;
      font-size: 15px;
    }

    /* Error Message */
    .error-message {
      color: #dc3545;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    .error-message.show {
      display: block;
    }

    /* Back Link */
    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .form-header {
        padding: 30px 20px;
      }

      .form-header h1 {
        font-size: 24px;
      }

      .form-body {
        padding: 30px 20px;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <div class="form-container"><!-- Header -->
   <div class="form-header">
    <h1>👤 Crear Perfil de Postulante</h1>
    <p>Completa tu información para comenzar a postularte</p>
   </div><!-- Form Body -->
   <div class="form-body"><!-- Success Message -->
    <div class="success-message" id="successMessage">
     <h3>✅ ¡Perfil Creado Exitosamente!</h3>
     <p>Tu perfil ha sido registrado. Ahora puedes postularte a vacantes.</p>
    </div><!-- Registration Form -->
    <div class="form-row">
      <div class="form-group"><label for="nombreCompleto" class="form-label"> Nombre Completo <span class="required">*</span> </label> <input type="text" id="nombreCompleto" name="nombreCompleto" class="form-input" placeholder="Ej: Juan Pérez García" maxlength="45" required aria-label="Nombre completo"> <span class="error-message" id="errorNombreCompleto"></span>
      </div>
      <div class="form-group"><label for="email" class="form-label"> Correo Electrónico <span class="required">*</span> </label> <input type="email" id="email" name="email" class="form-input" placeholder="empresa@ejemplo.com" maxlength="45" required aria-label="Correo electrónico"> <span class="error-message" id="errorEmail"></span>
      </div>
     </div>
     <div class="form-row">
      <div class="form-group"><label for="password" class="form-label"> Contraseña <span class="required">*</span> </label>
       <div class="password-wrapper"><input type="password" id="password" name="password" class="form-input" placeholder="••••••••" maxlength="50" required aria-label="Contraseña"> <button type="button" class="password-toggle" onclick="togglePassword('password')">👁️</button>
       </div><span class="form-help">Mínimo 8 caracteres</span> <span class="error-message" id="errorPassword"></span>
      </div>
      <div class="form-group"><label for="confirmPassword" class="form-label"> Confirmar Contraseña <span class="required">*</span> </label>
       <div class="password-wrapper"><input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="••••••••" maxlength="50" required aria-label="Confirmar contraseña"> <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">👁️</button>
       </div><span class="error-message" id="errorConfirmPassword"></span>
      </div>
    <form id="postulanteForm" action="procesar-postulante.php" method="POST" enctype="multipart/form-data"><!-- Hidden field for Usuario ID (from session) --> <input type="hidden" name="Usuarios_idUsuarios" value="<!-- idUsuarios desde sesión -->"> <!-- Número de Control -->
     <div class="form-group"><label for="numeroControl" class="form-label"> Número de Control <span class="required">*</span> </label> <input type="text" id="numeroControl" name="numeroControl" class="form-input" placeholder="Ej: 20240001" maxlength="10" required aria-label="Número de control"> <span class="form-help">Máximo 10 caracteres</span> <span class="error-message" id="errorNumeroControl"></span>
     </div><!-- Carrera -->
     <div class="form-group"><label for="Carrera_idCarrera" class="form-label"> Carrera <span class="required">*</span> </label> <select id="Carrera_idCarrera" name="Carrera_idCarrera" class="form-select" required aria-label="Carrera"> <option value="">-- Selecciona tu carrera --</option> <!-- Opciones desde la tabla Carrera --> <option value="1">Ingeniería en Sistemas Computacionales</option> <option value="2">Ingeniería Industrial</option> <option value="3">Ingeniería Mecatrónica</option> <option value="4">Ingeniería en Gestión Empresarial</option> <option value="5">Ingeniería Electrónica</option> <option value="6">Arquitectura</option> </select> <span class="error-message" id="errorCarrera"></span>
     </div><!-- Teléfono -->
     <div class="form-group"><label for="telefono" class="form-label"> Teléfono <span class="required">*</span> </label> <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="Ej: 664-123-4567" maxlength="45" required aria-label="Teléfono"> <span class="form-help">Incluye código de área</span> <span class="error-message" id="errorTelefono"></span>
     </div><!-- Ubicación -->
     <div class="form-group"><label for="ubicacion" class="form-label"> Ubicación <span class="required">*</span> </label> <input type="text" id="ubicacion" name="ubicacion" class="form-input" placeholder="Ej: Tijuana, Baja California" maxlength="45" required aria-label="Ubicación"> <span class="form-help">Ciudad y estado</span> <span class="error-message" id="errorUbicacion"></span>
     </div><!-- CV Upload -->
     <div class="form-group"><label for="cvFile" class="form-label"> Curriculum Vitae (CV) <span class="required">*</span> </label>
      <div class="file-input-wrapper"><input type="file" id="cvFile" name="cvFile" class="file-input" accept=".pdf,.doc,.docx" required aria-label="Curriculum vitae"> <label for="cvFile" class="file-input-label" id="cvLabel"> 📄 Seleccionar archivo CV (PDF, DOC, DOCX) </label>
      </div><span class="form-help">Máximo 5MB</span> <span class="error-message" id="errorCV"></span>
     </div><!-- Submit Button --> <button type="submit" class="btn-submit"> ✅ Crear Perfil de Postulante </button>
    </form>
   </div><!-- Info Box -->
   <div class="info-box">
    <h4>💡 Información Importante</h4>
    <p>Asegúrate de completar todos los campos correctamente. Tu CV debe estar en formato PDF, DOC o DOCX y no debe superar los 5MB.</p>
   </div>
   <script>
    // File input handler
    const cvInput = document.getElementById('cvFile');
    const cvLabel = document.getElementById('cvLabel');

    cvInput.addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name;
      const fileSize = e.target.files[0]?.size;
      
      if (fileName) {
        // Validate file size (5MB max)
        if (fileSize > 5 * 1024 * 1024) {
          const errorCV = document.getElementById('errorCV');
          errorCV.textContent = 'El archivo no debe superar los 5MB';
          errorCV.classList.add('show');
          cvInput.value = '';
          cvLabel.textContent = '📄 Seleccionar archivo CV (PDF, DOC, DOCX)';
          cvLabel.classList.remove('has-file');
          return;
        }

        cvLabel.textContent = `✅ ${fileName}`;
        cvLabel.classList.add('has-file');
        document.getElementById('errorCV').classList.remove('show');
      }
    });

    // Form validation and submission
    document.getElementById('postulanteForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Clear previous errors
      document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
      
      let hasError = false;

      // Validate Número de Control
      const numeroControl = document.getElementById('numeroControl').value.trim();
      if (numeroControl.length === 0 || numeroControl.length > 10) {
        const error = document.getElementById('errorNumeroControl');
        error.textContent = 'El número de control es obligatorio (máx. 10 caracteres)';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Carrera
      const carrera = document.getElementById('Carrera_idCarrera').value;
      if (!carrera) {
        const error = document.getElementById('errorCarrera');
        error.textContent = 'Debes seleccionar una carrera';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Teléfono
      const telefono = document.getElementById('telefono').value.trim();
      if (telefono.length === 0) {
        const error = document.getElementById('errorTelefono');
        error.textContent = 'El teléfono es obligatorio';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Ubicación
      const ubicacion = document.getElementById('ubicacion').value.trim();
      if (ubicacion.length === 0) {
        const error = document.getElementById('errorUbicacion');
        error.textContent = 'La ubicación es obligatoria';
        error.classList.add('show');
        hasError = true;
      }

      // Validate CV file
      const cvFile = document.getElementById('cvFile').files[0];
      if (!cvFile) {
        const error = document.getElementById('errorCV');
        error.textContent = 'Debes seleccionar un archivo CV';
        error.classList.add('show');
        hasError = true;
      }

      if (hasError) {
        return;
      }

      // Show success message
      document.getElementById('successMessage').classList.add('show');
      document.getElementById('successMessage').scrollIntoView({ behavior: 'smooth' });

      // Disable submit button
      const submitBtn = this.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.textContent = '✅ Perfil Creado';

      // In production, submit the form to PHP
      // this.submit();
    });
  </script>
  </div>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd02817746e574f',t:'MTc2ODI1NzYzNy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>