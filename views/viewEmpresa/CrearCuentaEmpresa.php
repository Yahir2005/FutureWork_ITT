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
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      min-height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    html {
      height: 100%;
    }

    /* Container */
    .register-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 900px;
      width: 100%;
      overflow: hidden;
    }

    /* Header */
    .register-header {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      padding: 40px;
      text-align: center;
      color: white;
    }

    .logo-circle {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #1e3c72;
      font-size: 32px;
      margin: 0 auto 20px;
    }

    .register-header h1 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .register-header p {
      font-size: 16px;
      opacity: 0.95;
    }

    /* Form */
    .register-form {
      padding: 40px;
    }

    /* Image Upload Section */
    .image-upload-section {
      text-align: center;
      margin-bottom: 35px;
      padding-bottom: 35px;
      border-bottom: 2px solid #f0f0f0;
    }

    .image-upload-label {
      display: block;
      color: #333;
      font-weight: 600;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .image-preview-container {
      position: relative;
      width: 150px;
      height: 150px;
      margin: 0 auto 20px;
    }

    .image-preview {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background: #f0f4ff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 64px;
      color: #2a5298;
      border: 4px solid #e0e0e0;
      overflow: hidden;
    }

    .image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
    }

    .upload-button {
      display: inline-block;
      padding: 12px 30px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .upload-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .file-input {
      display: none;
    }

    .file-name {
      color: #666;
      font-size: 13px;
      margin-top: 10px;
    }

    /* Form Grid */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
      margin-bottom: 25px;
    }

    .form-group-full {
      grid-column: 1 / -1;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      color: #333;
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .required {
      color: #e74c3c;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 14px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 15px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #2a5298;
      background: white;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .input-hint {
      color: #999;
      font-size: 12px;
      margin-top: 5px;
    }

    /* Section Title */
    .section-title {
      color: #1e3c72;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #f0f0f0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Checkbox */
    .checkbox-group {
      display: flex;
      align-items: start;
      gap: 10px;
      margin-bottom: 25px;
    }

    .checkbox-group input[type="checkbox"] {
      width: 20px;
      height: 20px;
      cursor: pointer;
      margin-top: 2px;
    }

    .checkbox-group label {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
      cursor: pointer;
    }

    .checkbox-group label a {
      color: #2a5298;
      text-decoration: none;
      font-weight: 600;
    }

    .checkbox-group label a:hover {
      text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    /* Login Link */
    .login-link {
      text-align: center;
      color: #666;
      font-size: 14px;
    }

    .login-link a {
      color: #2a5298;
      text-decoration: none;
      font-weight: 600;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    /* Info Box */
    .info-box {
      background: #f0f4ff;
      border-left: 4px solid #2a5298;
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 25px;
    }

    .info-box p {
      color: #555;
      font-size: 14px;
      line-height: 1.6;
      margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .register-container {
        margin: 20px;
      }

      .register-header {
        padding: 30px 20px;
      }

      .register-header h1 {
        font-size: 26px;
      }

      .register-form {
        padding: 30px 20px;
      }

      .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .logo-circle {
        width: 60px;
        height: 60px;
        font-size: 24px;
      }

      .image-preview-container,
      .image-preview {
        width: 120px;
        height: 120px;
      }

      .image-preview {
        font-size: 48px;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <div class="register-container"><!-- Header -->
   <div class="register-header">
    <div class="logo-circle">
     🏢
    </div>
    <h1>Registro de Empresa</h1>
    <p>Únete a FutureWork ITT y conecta con talento del Instituto Tecnológico de Tehuacán</p>
   </div><!-- Form -->
   <form class="register-form" method="POST" action="" enctype="multipart/form-data"><!-- Image Upload Section -->
    <div class="image-upload-section"><label class="image-upload-label">Logo de la Empresa</label>
     <div class="image-preview-container">
      <div class="image-preview" id="imagePreview">
       🏢 <img id="previewImg" alt="Preview">
      </div>
     </div><label for="logo_empresa" class="upload-button"> 📷 Seleccionar Logo </label> <input type="file" id="logo_empresa" name="logo_empresa" class="file-input" accept="image/*">
     <div class="file-name" id="fileName">
      Ningún archivo seleccionado
     </div>
    </div><!-- Info Box -->
    <div class="info-box">
     <p>📋 <strong>Nota:</strong> Tu cuenta será revisada por el equipo de FutureWork ITT antes de ser activada. Recibirás un correo de confirmación una vez aprobada.</p>
    </div><!-- Company Information -->
    <h3 class="section-title">🏢 Información de la Empresa</h3>
    <div class="form-grid">
     <div class="form-group form-group-full"><label for="nombre_empresa">Nombre de la Empresa <span class="required">*</span></label> <input type="text" id="nombre_empresa" name="nombre_empresa" required minlength="3" placeholder="Nombre comercial de tu empresa">
     </div>
     <div class="form-group"><label for="razon_social">Razón Social <span class="required">*</span></label> <input type="text" id="razon_social" name="razon_social" required minlength="3" placeholder="Razón social completa">
     </div>
     <div class="form-group"><label for="rfc">RFC <span class="required">*</span></label> <input type="text" id="rfc" name="rfc" required pattern="[A-ZÑ&amp;]{3,4}[0-9]{6}[A-Z0-9]{3}" placeholder="RFC de la empresa" maxlength="13"> <span class="input-hint">Ejemplo: ABC123456XYZ</span>
     </div>
     <div class="form-group"><label for="sector">Sector <span class="required">*</span></label> <select id="sector" name="sector" required> <option value="">Selecciona el sector</option> <option value="tecnologia">Tecnología</option> <option value="manufactura">Manufactura</option> <option value="automotriz">Automotriz</option> <option value="textil">Textil</option> <option value="alimentos">Alimentos y Bebidas</option> <option value="servicios">Servicios</option> <option value="construccion">Construcción</option> <option value="comercio">Comercio</option> <option value="salud">Salud</option> <option value="educacion">Educación</option> <option value="otro">Otro</option> </select>
     </div>
     <div class="form-group"><label for="telefono">Teléfono <span class="required">*</span></label> <input type="tel" id="telefono" name="telefono" required pattern="[0-9]{10}" placeholder="10 dígitos"> <span class="input-hint">Ejemplo: 2383803370</span>
     </div>
     <div class="form-group"><label for="sitio_web">Sitio Web</label> <input type="url" id="sitio_web" name="sitio_web" placeholder="https://www.tuempresa.com"> <span class="input-hint">Opcional</span>
     </div>
     <div class="form-group form-group-full"><label for="descripcion">Descripción de la Empresa <span class="required">*</span></label> <textarea id="descripcion" name="descripcion" required minlength="50" placeholder="Describe tu empresa, sus actividades principales, productos o servicios..."></textarea> <span class="input-hint">Mínimo 50 caracteres</span>
     </div>
    </div><!-- Address -->
    <h3 class="section-title">📍 Dirección</h3>
    <div class="form-grid">
     <div class="form-group form-group-full"><label for="direccion">Dirección Completa <span class="required">*</span></label> <input type="text" id="direccion" name="direccion" required minlength="10" placeholder="Calle, número, colonia">
     </div>
     <div class="form-group"><label for="ciudad">Ciudad <span class="required">*</span></label> <input type="text" id="ciudad" name="ciudad" required minlength="3" placeholder="Ciudad">
     </div>
     <div class="form-group"><label for="estado">Estado <span class="required">*</span></label> <input type="text" id="estado" name="estado" required minlength="3" placeholder="Estado">
     </div>
     <div class="form-group"><label for="codigo_postal">Código Postal <span class="required">*</span></label> <input type="text" id="codigo_postal" name="codigo_postal" required pattern="[0-9]{5}" placeholder="5 dígitos" maxlength="5">
     </div>
    </div><!-- Representative Information -->
    <h3 class="section-title">👤 Representante Legal / Contacto</h3>
    <div class="form-grid">
     <div class="form-group"><label for="nombre_representante">Nombre Completo <span class="required">*</span></label> <input type="text" id="nombre_representante" name="nombre_representante" required minlength="5" placeholder="Nombre del representante">
     </div>
     <div class="form-group"><label for="cargo_representante">Cargo <span class="required">*</span></label> <input type="text" id="cargo_representante" name="cargo_representante" required minlength="3" placeholder="Ej: Director General, Gerente de RRHH">
     </div>
     <div class="form-group"><label for="email_representante">Correo Electrónico <span class="required">*</span></label> <input type="email" id="email_representante" name="email_representante" required placeholder="correo@empresa.com"> <span class="input-hint">Usarás este correo para iniciar sesión</span>
     </div>
     <div class="form-group"><label for="telefono_representante">Teléfono del Representante <span class="required">*</span></label> <input type="tel" id="telefono_representante" name="telefono_representante" required pattern="[0-9]{10}" placeholder="10 dígitos">
     </div>
    </div><!-- Account Information -->
    <h3 class="section-title">🔐 Información de Cuenta</h3>
    <div class="form-grid">
     <div class="form-group"><label for="password">Contraseña <span class="required">*</span></label> <input type="password" id="password" name="password" required minlength="8" placeholder="Mínimo 8 caracteres">
     </div>
     <div class="form-group"><label for="confirm_password">Confirmar Contraseña <span class="required">*</span></label> <input type="password" id="confirm_password" name="confirm_password" required minlength="8" placeholder="Repite tu contraseña">
     </div>
    </div><!-- Terms and Conditions -->
    <div class="checkbox-group"><input type="checkbox" id="terminos" name="terminos" required> <label for="terminos"> Acepto los <a href="terminos.php" target="_blank">términos y condiciones</a> y la <a href="privacidad.php" target="_blank">política de privacidad</a> de FutureWork ITT <span class="required">*</span> </label>
    </div>
    <div class="checkbox-group"><input type="checkbox" id="verificacion" name="verificacion" required> <label for="verificacion"> Confirmo que la información proporcionada es verídica y que represento legalmente a esta empresa <span class="required">*</span> </label>
    </div><!-- Submit Button --> <button type="submit" class="btn-submit">🚀 Registrar Empresa</button> <!-- Login Link -->
    <div class="login-link">
     ¿Ya tienes una cuenta? <a href="login-empresa.php">Inicia sesión aquí</a>
    </div>
   </form>
  </div>
  <script>
    // Preview de imagen
    const fileInput = document.getElementById('logo_empresa');
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          imagePreview.style.fontSize = '0';
        }
        reader.readAsDataURL(file);
        fileName.textContent = file.name;
      }
    });

    // Validación de contraseñas
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');

    confirmPassword.addEventListener('input', function() {
      if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity('Las contraseñas no coinciden');
      } else {
        confirmPassword.setCustomValidity('');
      }
    });

    // Convertir RFC a mayúsculas
    const rfcInput = document.getElementById('rfc');
    rfcInput.addEventListener('input', function() {
      this.value = this.value.toUpperCase();
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99cb635276d1ae76',t:'MTc2MjgzODkyNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>