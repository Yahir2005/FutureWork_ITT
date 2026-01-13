<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Registro de Empresa</title>
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
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      box-sizing: border-box;
    }

    html {
      height: 100%;
    }

    /* Main Container */
    .form-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 700px;
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
      font-size: 32px;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .form-header p {
      font-size: 16px;
      opacity: 0.95;
    }

    /* Form Body */
    .form-body {
      padding: 40px 30px;
    }

    .section-title {
      color: #2c3e50;
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e9ecef;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Form Group */
    .form-group {
      margin-bottom: 25px;
    }

    .form-row {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
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
    .form-select,
    .form-textarea {
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

    .form-textarea {
      min-height: 100px;
      resize: vertical;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
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

    /* Password Toggle */
    .password-wrapper {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #6c757d;
      cursor: pointer;
      font-size: 18px;
      padding: 5px;
    }

    .password-toggle:hover {
      color: #495057;
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

    /* Info Box */
    .info-box {
      background: #fff3cd;
      border: 2px solid #ffc107;
      border-radius: 8px;
      padding: 20px;
      margin-top: 25px;
    }

    .info-box h4 {
      color: #856404;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .info-box p {
      color: #856404;
      font-size: 14px;
      line-height: 1.6;
    }

    /* Back Link */
    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #2c4bd4;
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
        font-size: 26px;
      }

      .form-body {
        padding: 30px 20px;
      }

      .form-row {
        grid-template-columns: 1fr;
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
    <h1>🏢 Registro de Empresa</h1>
    <p>Únete a FutureWork ITT y encuentra el mejor talento</p>
   </div><!-- Form Body -->
   <div class="form-body"><!-- Success Message -->
    <div class="success-message" id="successMessage">
     <h3>✅ ¡Registro Exitoso!</h3>
     <p>Tu empresa ha sido registrada. Estamos validando tu información y te notificaremos pronto.</p>
    </div><!-- Registration Form -->
    <form id="empresaForm" action="procesar-registro-empresa.php" method="POST"><!-- Sección: Datos de Usuario -->
     <h3 class="section-title">👤 Datos de Acceso</h3>
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
     </div><!-- Hidden: Rol_idRol (2 = Empresa) --> <input type="hidden" name="Rol_idRol" value="2"> <!-- Sección: Datos de Empresa -->
     <h3 class="section-title" style="margin-top: 30px;">🏢 Información de la Empresa</h3>
     <div class="form-group"><label for="nombreEmpresa" class="form-label"> Nombre de la Empresa <span class="required">*</span> </label> <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="form-input" placeholder="Ej: Tecnología Avanzada S.A. de C.V." maxlength="45" required aria-label="Nombre de la empresa"> <span class="error-message" id="errorNombreEmpresa"></span>
     </div>
     <div class="form-row">
      <div class="form-group"><label for="sector" class="form-label"> Sector <span class="required">*</span> </label> <select id="sector" name="sector" class="form-select" required aria-label="Sector"> <option value="">-- Selecciona el sector --</option> <option value="Tecnología">Tecnología</option> <option value="Manufactura">Manufactura</option> <option value="Automotriz">Automotriz</option> <option value="Aeroespacial">Aeroespacial</option> <option value="Electrónica">Electrónica</option> <option value="Logística">Logística</option> <option value="Consultoría">Consultoría</option> <option value="Construcción">Construcción</option> <option value="Retail">Retail</option> <option value="Servicios">Servicios</option> <option value="Otro">Otro</option> </select> <span class="error-message" id="errorSector"></span>
      </div>
      <div class="form-group"><label for="representante" class="form-label"> Representante Legal <span class="required">*</span> </label> <input type="text" id="representante" name="representante" class="form-input" placeholder="Ej: María González López" maxlength="45" required aria-label="Representante legal"> <span class="error-message" id="errorRepresentante"></span>
      </div>
     </div>
     <div class="form-group"><label for="sitioWeb" class="form-label"> Sitio Web </label> <input type="url" id="sitioWeb" name="sitioWeb" class="form-input" placeholder="https://www.ejemplo.com" maxlength="45" aria-label="Sitio web"> <span class="form-help">Opcional</span> <span class="error-message" id="errorSitioWeb"></span>
     </div>
     <div class="form-group"><label for="descripcion" class="form-label"> Descripción de la Empresa <span class="required">*</span> </label> <textarea id="descripcion" name="descripcion" class="form-textarea" placeholder="Describe brevemente tu empresa, sus actividades principales y valores..." required aria-label="Descripción de la empresa"></textarea> <span class="form-help">Cuéntanos sobre tu empresa</span> <span class="error-message" id="errorDescripcion"></span>
     </div><!-- Hidden: EstadoValidacionEmpresa_idEstadoValidacionEmpresa (1 = En Revisión por defecto) --> <input type="hidden" name="EstadoValidacionEmpresa_idEstadoValidacionEmpresa" value="1"> <!-- Submit Button --> <button type="submit" class="btn-submit"> ✅ Registrar Empresa </button>
    </form><!-- Info Box -->
    <div class="info-box">
     <h4>⚠️ Proceso de Validación</h4>
     <p>Tu registro será revisado por nuestro equipo administrativo. Recibirás un correo de confirmación una vez que tu empresa haya sido validada. Este proceso puede tomar de 1 a 3 días hábiles.</p>
    </div><!-- Back Link -->
    <div class="back-link"><a href="login.html">¿Ya tienes cuenta? Inicia sesión aquí</a>
    </div>
   </div>
  </div>
  <script>
    // Toggle password visibility
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const button = input.nextElementSibling;
      
      if (input.type === 'password') {
        input.type = 'text';
        button.textContent = '🙈';
      } else {
        input.type = 'password';
        button.textContent = '👁️';
      }
    }

    // Form validation and submission
    document.getElementById('empresaForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Clear previous errors
      document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
      
      let hasError = false;

      // Validate Nombre Completo
      const nombreCompleto = document.getElementById('nombreCompleto').value.trim();
      if (nombreCompleto.length === 0) {
        const error = document.getElementById('errorNombreCompleto');
        error.textContent = 'El nombre completo es obligatorio';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Email
      const email = document.getElementById('email').value.trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        const error = document.getElementById('errorEmail');
        error.textContent = 'Ingresa un correo electrónico válido';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Password
      const password = document.getElementById('password').value;
      if (password.length < 8) {
        const error = document.getElementById('errorPassword');
        error.textContent = 'La contraseña debe tener al menos 8 caracteres';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Confirm Password
      const confirmPassword = document.getElementById('confirmPassword').value;
      if (password !== confirmPassword) {
        const error = document.getElementById('errorConfirmPassword');
        error.textContent = 'Las contraseñas no coinciden';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Nombre Empresa
      const nombreEmpresa = document.getElementById('nombreEmpresa').value.trim();
      if (nombreEmpresa.length === 0) {
        const error = document.getElementById('errorNombreEmpresa');
        error.textContent = 'El nombre de la empresa es obligatorio';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Sector
      const sector = document.getElementById('sector').value;
      if (!sector) {
        const error = document.getElementById('errorSector');
        error.textContent = 'Debes seleccionar un sector';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Representante
      const representante = document.getElementById('representante').value.trim();
      if (representante.length === 0) {
        const error = document.getElementById('errorRepresentante');
        error.textContent = 'El representante legal es obligatorio';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Descripción
      const descripcion = document.getElementById('descripcion').value.trim();
      if (descripcion.length === 0) {
        const error = document.getElementById('errorDescripcion');
        error.textContent = 'La descripción de la empresa es obligatoria';
        error.classList.add('show');
        hasError = true;
      }

      // Validate Sitio Web (optional but must be valid URL if provided)
      const sitioWeb = document.getElementById('sitioWeb').value.trim();
      if (sitioWeb.length > 0) {
        try {
          new URL(sitioWeb);
        } catch (_) {
          const error = document.getElementById('errorSitioWeb');
          error.textContent = 'Ingresa una URL válida (ej: https://www.ejemplo.com)';
          error.classList.add('show');
          hasError = true;
        }
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
      submitBtn.textContent = '✅ Registro Enviado';

      // In production, submit the form to PHP
      // this.submit();
      
      /* 
      PHP Processing Steps:
      
      1. Insertar en tabla Usuarios:
         INSERT INTO Usuarios (Rol_idRol, nombreCompleto, email, Password)
         VALUES (2, ?, ?, ?)
         
      2. Obtener el idUsuarios generado:
         $idUsuarios = mysqli_insert_id($conn);
         
      3. Insertar en tabla Empresas:
         INSERT INTO Empresas (
           Usuarios_idUsuarios, 
           EstadoValidacionEmpresa_idEstadoValidacionEmpresa,
           nombreEmpresa,
           sector,
           representante,
           descripcion,
           sitioWeb
         )
         VALUES (?, 1, ?, ?, ?, ?, ?)
         
      4. Enviar email de confirmación al usuario
      5. Notificar a administradores para validación
      */
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd0337fe654f863',t:'MTc2ODI1ODEwNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>