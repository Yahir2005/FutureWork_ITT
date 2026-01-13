<?php

?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Contacto</title>
    <link rel="stylesheet" href="css/Contacto.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <h1>📧 Contáctanos</h1>
    <p>¿Tienes preguntas o necesitas ayuda? Estamos aquí para asistirte. Envíanos un mensaje y te responderemos pronto.</p>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Mensajes de alerta --> <!-- 
    <div class="alert alert-success">
      ✓ Tu mensaje ha sido enviado exitosamente. Te responderemos pronto.
    </div>
    <div class="alert alert-error">
      ✗ Error al enviar el mensaje. Por favor intenta nuevamente.
    </div>
    --> <!-- Contact Grid -->
   <div class="contact-grid"><!-- Contact Form -->
    <div class="contact-form-section">
     <h2 class="section-title">📝 Envíanos un Mensaje</h2>
     <p class="section-subtitle">Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>
     <form method="POST" action="">
      <div class="form-group"><label for="nombre">Nombre Completo <span class="required">*</span></label> <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
      </div>
      <div class="form-group"><label for="email">Correo Electrónico <span class="required">*</span></label> <input type="email" id="email" name="email" placeholder="tu@email.com" required>
      </div>
      <div class="form-group"><label for="telefono">Teléfono</label> <input type="tel" id="telefono" name="telefono" placeholder="(555) 123-4567">
      </div>
      <div class="form-group"><label for="asunto">Asunto <span class="required">*</span></label> <select id="asunto" name="asunto" required> <option value="">Selecciona un asunto</option> <option value="consulta_general">Consulta General</option> <option value="soporte_tecnico">Soporte Técnico</option> <option value="registro_empresa">Registro de Empresa</option> <option value="publicar_vacante">Publicar Vacante</option> <option value="problema_cuenta">Problema con mi Cuenta</option> <option value="sugerencia">Sugerencia o Feedback</option> <option value="otro">Otro</option> </select>
      </div>
      <div class="form-group"><label for="mensaje">Mensaje <span class="required">*</span></label> <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
      </div><button type="submit" class="btn-submit"> 📤 Enviar Mensaje </button>
     </form>
    </div><!-- Contact Info -->
    <div class="contact-info-section"><!-- Email Card -->
     <div class="info-card">
      <div class="info-card-header">
       <div class="info-icon">
        📧
       </div>
       <h3>Correo Electrónico</h3>
      </div>
      <p>Envíanos un correo y te responderemos en menos de 24 horas.</p><a href="mailto:contacto@futureworkitt.edu.mx">contacto@futureworkitt.edu.mx</a>
     </div><!-- Phone Card -->
     <div class="info-card">
      <div class="info-card-header">
       <div class="info-icon">
        📞
       </div>
       <h3>Teléfono</h3>
      </div>
      <p>Llámanos de Lunes a Viernes de 9:00 AM a 6:00 PM</p><a href="tel:+525512345678">+52 (55) 1234-5678</a>
     </div><!-- Location Card -->
     <div class="info-card">
      <div class="info-card-header">
       <div class="info-icon">
        📍
       </div>
       <h3>Ubicación</h3>
      </div>
      <p>Instituto Tecnológico de Tijuana<br>
        Calzada Tecnológico S/N<br>
        Tijuana, Baja California, México<br>
        C.P. 22414</p>
     </div><!-- Social Media Card -->
     <div class="info-card">
      <div class="info-card-header">
       <div class="info-icon">
        🌐
       </div>
       <h3>Redes Sociales</h3>
      </div>
      <p>Síguenos en nuestras redes sociales para estar al día con las últimas novedades.</p>
      <div class="social-links"><a href="#" class="social-link" title="Facebook">📘</a> <a href="#" class="social-link" title="Twitter">🐦</a> <a href="#" class="social-link" title="LinkedIn">💼</a> <a href="#" class="social-link" title="Instagram">📷</a>
      </div>
     </div>
    </div>
   </div><!-- Map Section -->
   <div class="map-section">
    <h2 class="section-title">🗺️ Encuéntranos</h2>
    <p class="section-subtitle">Visítanos en nuestras instalaciones del Instituto Tecnológico de Tijuana.</p><!-- Placeholder para mapa (aquí se integraría Google Maps o similar) -->
    <div class="map-placeholder">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1892.5137890264825!2d-97.39848426153875!3d18.437056940198197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c5bd02da78a331%3A0x699aa58e5f6d412e!2sInstituto%20Tecnol%C3%B3gico%20de%20Tehuac%C3%A1n!5e0!3m2!1ses-419!2smx!4v1768283293567!5m2!1ses-419!2smx" 
            width="100%" 
            height="100%" 
            style="border:0; display:block;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
   </div><!-- FAQ Section -->
   <div class="faq-section">
    <h2 class="section-title">❓ Preguntas Frecuentes</h2>
    <p class="section-subtitle">Encuentra respuestas rápidas a las preguntas más comunes.</p>
    <div class="faq-item">
     <div class="faq-question">
      💡 ¿Cómo puedo registrar mi empresa en la plataforma?
     </div>
     <div class="faq-answer">
      Para registrar tu empresa, dirígete a la sección de "Registro de Empresas" en el menú principal. Completa el formulario con la información de tu empresa y espera la validación del administrador.
     </div>
    </div>
    <div class="faq-item">
     <div class="faq-question">
      💡 ¿Cuánto tiempo tarda en aprobarse una vacante?
     </div>
     <div class="faq-answer">
      Las vacantes son revisadas por nuestro equipo en un plazo de 24 a 48 horas hábiles. Recibirás una notificación por correo electrónico una vez que tu vacante sea aprobada o si requiere modificaciones.
     </div>
    </div>
    <div class="faq-item">
     <div class="faq-question">
      💡 ¿La plataforma tiene algún costo?
     </div>
     <div class="faq-answer">
      No, FutureWork ITT es una plataforma completamente gratuita tanto para empresas como para estudiantes y egresados del Instituto Tecnológico de Tijuana.
     </div>
    </div>
    <div class="faq-item">
     <div class="faq-question">
      💡 ¿Cómo puedo editar o eliminar una vacante publicada?
     </div>
     <div class="faq-answer">
      Desde tu panel de "Mis Vacantes", encontrarás las opciones de editar o eliminar cada vacante publicada. Los cambios en vacantes ya aprobadas requerirán una nueva revisión.
     </div>
    </div>
    <div class="faq-item">
     <div class="faq-question">
      💡 ¿Qué hago si olvidé mi contraseña?
     </div>
     <div class="faq-answer">
      En la página de inicio de sesión, haz clic en "¿Olvidaste tu contraseña?" y sigue las instrucciones para recuperar el acceso a tu cuenta mediante tu correo electrónico registrado.
     </div>
    </div>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a159e37a612b1f2',t:'MTc2MzYxNzI4My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>