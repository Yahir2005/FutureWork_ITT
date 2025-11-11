<?php
// --- LÓGICA DE BACKEND (DE LOGIN 1) ---
require_once __DIR__ . "/usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/usecase/Usuario/SessionManager.php";

$error = null; // Variable para almacenar el mensaje de error

// Comprobar si el formulario fue enviado
if (isset($_POST['enviar'])) {
  $controllerUsuario = new UsuarioController();
  $response = null;

  // Lógica para tipo de acceso
  if ($_POST['tipo_acceso'] === 'invitado') {
    // Si es invitado, usa credenciales fijas
    $response = $controllerUsuario->iniciarSesion("invitado", "invitado");
  } else {
    // Para otros roles, usa los datos del formulario
    // (Asegúrate de que 'usuario' y 'password' no estén vacíos si no es invitado)
    if (empty($_POST['usuario']) || empty($_POST['password'])) {
      $error = "El usuario y la contraseña son obligatorios.";
    } else {
      $response = $controllerUsuario->iniciarSesion($_POST['usuario'], $_POST['password']);
    }
  }

  // Procesar la respuesta del controlador
  if ($response && $response->status == "ok") {
    SessionManager::startSession();
    $_SESSION["idUsuarios"] = $response->body["idUsuarios"];
    $_SESSION["estudianteId"] = $response->body["EstudianteId"];
    header("Location:views/view/index.php");
    exit; // Importante: detener la ejecución después de redirigir
  } else {
    // Si la respuesta no es 'ok' o $response es nulo (p.ej. por validación previa)
    if (!$error) {
      $error = "Usuario o contraseña incorrecta."; // Mensaje de error genérico
    }
  }
}
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Iniciar Sesión</title>
  <link rel="stylesheet" href="views/css/login.css">
 </head>
 <body>
  <div class="login-container"><div class="login-left">
    <div class="logo"><span class="logo-text">FW</span>
    </div>
    <h1>FutureWork ITT</h1>
    <p>Plataforma de Vinculación Laboral del Instituto Tecnológico de Tehuacán</p>
    <div class="features">
     <div class="feature-item"><span class="feature-icon">🎓</span> <span>Conecta con egresados</span>
     </div>
     <div class="feature-item"><span class="feature-icon">💼</span> <span>Encuentra oportunidades</span>
     </div>
     <div class="feature-item"><span class="feature-icon">🚀</span> <span>Impulsa tu carrera</span>
     </div>
    </div>
   </div><div class="login-right">
    <div class="login-header">
     <h2>Iniciar Sesión</h2>
     <p>Accede a tu cuenta de FutureWork ITT</p>
    </div>
    
    <div class="error-message" id="errorMessage">
     </div>
    
    <form method="POST" action="">
     <div class="form-group"><label for="tipo_acceso">Tipo de Acceso</label> <select name="tipo_acceso" id="tipo_acceso" required> <option value="">Selecciona una opción</option> <option value="egresado">Egresado</option> <option value="empresa">Empresa</option> <option value="administrador">Administrador</option> <option value="invitado">Invitado</option> </select>
     </div>
     <div class="form-group" id="usuarioGroup"><label for="usuario">Usuario o Correo Electrónico</label> <input type="text" name="usuario" id="usuario" placeholder="Ingresa tu usuario o correo" required>
     </div>
     <div class="form-group password-toggle" id="passwordGroup"><label for="password">Contraseña</label> <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required> <button type="button" class="toggle-btn" onclick="togglePassword()">👁️</button>
     </div>
     <div class="remember-forgot"><label class="remember-me"> <input type="checkbox" name="remember"> <span>Recordarme</span> </label> <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
     </div>
     
     <button type="submit" name="enviar" class="btn-primary"> Iniciar Sesión </button>
     
     <div class="divider"><span>O</span>
     </div>
     
     <button type="submit" name="enviar" class="btn-guest" onclick="setInvitado(event)"> 🌐 Acceder como Invitado </button>
    </form>
    <div class="register-link">
     ¿No tienes cuenta? <a href="views/OpcionUser.php">Regístrate aquí</a>
    </div>
   </div>
  </div>
  
  <script>
    // Toggle para mostrar/ocultar contraseña
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleBtn = event.target;
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleBtn.textContent = '🙈';
      } else {
        passwordInput.type = 'password';
        toggleBtn.textContent = '👁️';
      }
    }

    // Función para acceso como invitado
    function setInvitado(event) {
      // Esta función se activa con el botón "Acceder como Invitado"
      // Ayuda a que la lógica PHP funcione correctamente
      document.getElementById('tipo_acceso').value = 'invitado';
      
      // Aunque el PHP de Login 1 ignora estos valores cuando 'tipo_acceso' es 'invitado',
      // es buena práctica llenarlos para evitar errores de 'required'
      document.getElementById('usuario').value = 'invitado';
      document.getElementById('password').value = 'invitado';
      
      // No necesitamos prevenir el default, solo dejamos que el form se envíe
      // El 'type="submit"' del botón hará el trabajo.
    }

    // Mostrar/ocultar campos según tipo de acceso
    document.getElementById('tipo_acceso').addEventListener('change', function() {
      const usuarioGroup = document.getElementById('usuarioGroup');
      const passwordGroup = document.getElementById('passwordGroup');
      
      if (this.value === 'invitado') {
        usuarioGroup.style.display = 'none';
        passwordGroup.style.display = 'none';
        document.getElementById('usuario').required = false;
        document.getElementById('password').required = false;
      } else {
        usuarioGroup.style.display = 'block';
        passwordGroup.style.display = 'block';
        document.getElementById('usuario').required = true;
        document.getElementById('password').required = true;
      }
    });

    // --- CONEXIÓN DE PHP CON JS (PARA MOSTRAR ERRORES) ---
    <?php
    if (isset($error)) { 
        // Si la variable $error existe (definida en el PHP de arriba),
        // inyecta JS para mostrar el mensaje.
        echo "
        document.addEventListener('DOMContentLoaded', function() {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = '" . addslashes($error) . "';
            errorDiv.classList.add('show');
        });
        "; 
    }
    ?>
  </script>
 </body>
</html>