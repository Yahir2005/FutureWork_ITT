<?php

?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Agregar Vacante</title>
  <link rel="stylesheet" href="../css/VacantesAddView.css">
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <div class="form-container">
   <div class="form-header">
    <h1>💼 Agregar Nueva Vacante</h1>
    <p>Publica una nueva oportunidad laboral</p>
   </div>
   <div class="form-content"><!-- Aquí irán los mensajes de éxito o error desde PHP --> <!-- 
      <div class="alert alert-success">
        ¡Vacante agregada exitosamente!
      </div>
      -->
    <form method="POST" action="">
     <h3 class="section-title">📋 Información Básica</h3>
     <div class="form-grid">
      <div class="form-group form-group-full"><label for="titulo">Título de la Vacante <span class="required">*</span></label> <input type="text" id="titulo" name="titulo" required placeholder="Ej: Desarrollador Full Stack">
      </div>
      <div class="form-group form-group-full"><label for="descripcion">Descripción de la Vacante <span class="required">*</span></label> <textarea id="descripcion" name="descripcion" required placeholder="Describe las responsabilidades y funciones del puesto..."></textarea>
      </div>
      <div class="form-group"><label for="ubicacion">Ubicación <span class="required">*</span></label> <input type="text" id="ubicacion" name="ubicacion" required placeholder="Ej: Tehuacán, Puebla">
      </div>
      <div class="form-group"><label for="salario">Salario</label> <input type="number" id="salario" name="salario" min="0" step="0.01" placeholder="Ej: 15000.00"> <span class="input-hint">Opcional - En pesos mexicanos</span>
      </div>
      <div class="form-group"><label for="fechaLimite">Fecha Límite</label> <input type="date" id="fechaLimite" name="fechaLimite"> <span class="input-hint">Opcional - Fecha límite para postularse</span>
      </div>
     </div>
     <h3 class="section-title">💼 Detalles del Contrato</h3>
     <div class="form-grid">
      <div class="form-group"><label for="idEstadoValidacionVacante">Estado de Validación <span class="required">*</span></label> <select id="idEstadoValidacionVacante" name="idEstadoValidacionVacante" required> <option value="">Selecciona el estado</option> <option value="1">Abierta</option> <option value="2">Cerrada</option> <option value="3">Pausada</option> </select>
      </div>
      <div class="form-group"><label for="idTipoContrato">Tipo de Contrato <span class="required">*</span></label> <select id="idTipoContrato" name="idTipoContrato" required> <option value="">Selecciona el tipo</option> <option value="1">Tiempo Completo</option> <option value="2">Medio Tiempo</option> <option value="3">Por Proyecto</option> <option value="4">Pasantía</option> </select>
      </div>
      <div class="form-group"><label for="idTipoModalidad">Tipo de Modalidad <span class="required">*</span></label> <select id="idTipoModalidad" name="idTipoModalidad" required> <option value="">Selecciona la modalidad</option> <option value="1">Presencial</option> <option value="2">Remoto</option> <option value="3">Híbrido</option> </select>
      </div>
      <div class="form-group"><label for="idEmpresa">ID Empresa <span class="required">*</span></label> <input type="number" id="idEmpresa" name="idEmpresa" required placeholder="ID de la empresa"> <span class="input-hint">ID de la empresa que publica la vacante</span>
      </div>
     </div>
     <h3 class="section-title">🎓 Requisitos</h3>
     <div class="form-grid">
      <div class="form-group form-group-full"><label for="requisitos">Requisitos y Habilidades</label> <textarea id="requisitos" name="requisitos" placeholder="Lista los requisitos, habilidades y conocimientos necesarios..."></textarea> <span class="input-hint">Opcional - Describe los requisitos del puesto</span>
      </div>
     </div><button type="submit" class="btn-submit">💼 Publicar Vacante</button>
     <div class="back-link"><a href="vacantes.php">← Volver a la lista de vacantes</a>
     </div>
    </form>
   </div>
  </div>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a0cedfb069bb1f2',t:'MTc2MzUyNjE3OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>