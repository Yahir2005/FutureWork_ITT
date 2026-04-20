<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Postular a Vacante</title>
    <link rel="stylesheet" href="css/PostularseView.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-text">
     <h1>✉️ Postular a Vacante</h1>
     <p>Completa el formulario para enviar tu postulación</p>
    </div><a href="buscar-vacantes.html" class="btn-back">← Volver a Vacantes</a>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Content Grid -->
   <div class="content-grid"><!-- Main Content -->
    <div><!-- Vacancy Info -->
     <div class="card">
      <div class="vacancy-info">
       <h3><!-- titulo de Vacantes --></h3><a href="perfil-empresa.html?id=<!-- Empresa_idEmpresa -->" class="vacancy-company"> 🏢 <!-- Nombre de Empresa --> </a>
       <div class="vacancy-details">
        <div class="detail-item"><span class="detail-label">Ubicación</span> <span class="detail-value">📍 <!-- ubicacion --></span>
        </div>
        <div class="detail-item"><span class="detail-label">Salario</span> <span class="detail-value">💰 $<!-- salario --> MXN</span>
        </div>
        <div class="detail-item"><span class="detail-label">Tipo de Contrato</span> <span class="detail-value">📋 <!-- TipoContrato --></span>
        </div>
        <div class="detail-item"><span class="detail-label">Modalidad</span> <span class="detail-value">💼 <!-- TipoModalidad --></span>
        </div>
       </div>
      </div>
     </div><!-- Success Message (hidden by default) -->
     <div class="success-message" id="successMessage">
      <h3>✅ ¡Postulación Enviada Exitosamente!</h3>
      <p>Tu postulación ha sido registrada. La empresa revisará tu perfil y se pondrá en contacto contigo si cumples con los requisitos.</p>
     </div><!-- Application Form -->
     <div class="card">
      <div class="card-header">
       <h2 class="card-title">📝 Formulario de Postulación</h2>
       <p class="card-subtitle">Los campos marcados con <span style="color: #dc3545;">*</span> son obligatorios</p>
      </div>
      <form id="applicationForm" action="procesar-postulacion.php" method="POST" enctype="multipart/form-data"><!-- Hidden field for Vacante ID --> <input type="hidden" name="Vacantes_idVacante" value="<!-- idVacante desde URL -->"> <!-- Hidden field for Postulante ID (from session) --> <input type="hidden" name="Postulantes_idPostulante" value="<!-- idPostulante desde sesión -->"> <!-- Nombre Completo -->
       <div class="form-group"><label for="nombreCompleto" class="form-label"> Nombre Completo <span class="required">*</span> </label> <input type="text" id="nombreCompleto" name="nombreCompleto" class="form-input" placeholder="Ej: Juan Pérez García" required aria-label="Nombre completo">
       </div><!-- Correo Electrónico -->
       <div class="form-group"><label for="correo" class="form-label"> Correo Electrónico <span class="required">*</span> </label> <input type="email" id="correo" name="correo" class="form-input" placeholder="correo@ejemplo.com" required aria-label="Correo electrónico">
       </div><!-- Teléfono -->
       <div class="form-group"><label for="telefono" class="form-label"> Teléfono <span class="required">*</span> </label> <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="Ej: 664-123-4567" required aria-label="Teléfono">
       </div><!-- Carta de Presentación -->
       <div class="form-group"><label for="cartaPresentacion" class="form-label"> Carta de Presentación <span class="required">*</span> </label> <textarea id="cartaPresentacion" name="cartaPresentacion" class="form-textarea" placeholder="Cuéntanos por qué eres el candidato ideal para esta posición..." required aria-label="Carta de presentación"></textarea> <span class="form-help">Mínimo 100 caracteres</span>
       </div><!-- CV (Curriculum Vitae) -->
       <div class="form-group"><label for="cv" class="form-label"> Curriculum Vitae (CV) <span class="required">*</span> </label> <input type="file" id="cv" name="cv" class="file-input" accept=".pdf,.doc,.docx" required aria-label="Curriculum vitae"> <span class="form-help">Formatos aceptados: PDF, DOC, DOCX (Máx. 5MB)</span>
       </div><!-- Años de Experiencia -->
       <div class="form-group"><label for="anosExperiencia" class="form-label"> Años de Experiencia <span class="required">*</span> </label> <input type="number" id="anosExperiencia" name="anosExperiencia" class="form-input" placeholder="Ej: 3" min="0" max="50" required aria-label="Años de experiencia">
       </div><!-- Nivel de Educación -->
       <div class="form-group"><label for="nivelEducacion" class="form-label"> Nivel de Educación <span class="required">*</span> </label> <select id="nivelEducacion" name="nivelEducacion" class="form-select" required aria-label="Nivel de educación"> <option value="">Selecciona tu nivel de educación</option> <option value="Secundaria">Secundaria</option> <option value="Preparatoria">Preparatoria</option> <option value="Técnico">Técnico</option> <option value="Licenciatura">Licenciatura</option> <option value="Ingeniería">Ingeniería</option> <option value="Maestría">Maestría</option> <option value="Doctorado">Doctorado</option> </select>
       </div><!-- Habilidades Relevantes -->
       <div class="form-group"><label for="habilidades" class="form-label"> Habilidades Relevantes </label> <textarea id="habilidades" name="habilidades" class="form-textarea" placeholder="Ej: JavaScript, React, Node.js, SQL, Trabajo en equipo..." aria-label="Habilidades relevantes"></textarea> <span class="form-help">Separa las habilidades con comas</span>
       </div><!-- Disponibilidad -->
       <div class="form-group"><label for="disponibilidad" class="form-label"> Disponibilidad <span class="required">*</span> </label> <select id="disponibilidad" name="disponibilidad" class="form-select" required aria-label="Disponibilidad"> <option value="">Selecciona tu disponibilidad</option> <option value="Inmediata">Inmediata</option> <option value="1 semana">1 semana</option> <option value="2 semanas">2 semanas</option> <option value="1 mes">1 mes</option> <option value="Más de 1 mes">Más de 1 mes</option> </select>
       </div><!-- Pretensión Salarial -->
       <div class="form-group"><label for="pretensionSalarial" class="form-label"> Pretensión Salarial (MXN) </label> <input type="number" id="pretensionSalarial" name="pretensionSalarial" class="form-input" placeholder="Ej: 25000" min="0" step="1000" aria-label="Pretensión salarial"> <span class="form-help">Opcional - Indica tu expectativa salarial mensual</span>
       </div><!-- Términos y Condiciones -->
       <div class="checkbox-group"><input type="checkbox" id="terminos" name="terminos" class="checkbox-input" required aria-label="Aceptar términos y condiciones"> <label for="terminos" class="checkbox-label"> Acepto los <a href="terminos.html" target="_blank">términos y condiciones</a> y autorizo el uso de mis datos personales para fines de reclutamiento. <span style="color: #dc3545;">*</span> </label>
       </div><!-- Submit Button --> <button type="submit" class="btn-submit"> ✉️ Enviar Postulación </button>
      </form>
     </div>
    </div><!-- Sidebar -->
    <aside><!-- Requirements -->
     <div class="requirements-box">
      <h3>📋 Requisitos de la Vacante</h3>
      <ul class="requirements-list"><!-- Parsear requisitos de Vacantes -->
       <li>Requisito 1</li>
       <li>Requisito 2</li>
       <li>Requisito 3</li>
      </ul>
     </div><!-- Tips -->
     <div class="info-box">
      <h4>💡 Consejos para tu Postulación</h4>
      <ul>
       <li>Revisa que tu CV esté actualizado</li>
       <li>Personaliza tu carta de presentación</li>
       <li>Destaca tus logros relevantes</li>
       <li>Verifica que tus datos sean correctos</li>
       <li>Sé honesto sobre tu experiencia</li>
      </ul>
     </div><!-- Contact Info -->
     <div class="card">
      <h3 style="color: #2c3e50; font-size: 18px; font-weight: 700; margin-bottom: 15px;">📞 ¿Necesitas Ayuda?</h3>
      <p style="color: #495057; font-size: 14px; line-height: 1.6; margin-bottom: 10px;">Si tienes dudas sobre el proceso de postulación, contáctanos:</p>
      <p style="color: #2a5298; font-size: 14px; font-weight: 600;">📧 soporte@futureworkitt.com</p>
      <p style="color: #2a5298; font-size: 14px; font-weight: 600;">📱 664-123-4567</p>
     </div>
    </aside>
   </div>
  </main>
  <script>
    // Form validation and submission
    document.getElementById('applicationForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validate carta de presentación length
      const carta = document.getElementById('cartaPresentacion').value;
      if (carta.length < 100) {
        alert('La carta de presentación debe tener al menos 100 caracteres.');
        return;
      }

      // Validate file size
      const cvFile = document.getElementById('cv').files[0];
      if (cvFile && cvFile.size > 5 * 1024 * 1024) {
        alert('El archivo CV no debe superar los 5MB.');
        return;
      }

      // Show success message
      document.getElementById('successMessage').classList.add('show');
      
      // Scroll to success message
      document.getElementById('successMessage').scrollIntoView({ behavior: 'smooth' });
      
      // Reset form
      this.reset();
      
      // In production, submit the form to PHP
      // this.submit();
    });

    // File input display
    document.getElementById('cv').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name;
      if (fileName) {
        console.log('Archivo seleccionado:', fileName);
      }
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a783f46c6ddb6df',t:'MTc2NDY1MTQ4NS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>