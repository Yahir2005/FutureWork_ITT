<?php
  require_once __DIR__ ."usecase/Usuario/UsuarioController.php";
  require_once __DIR__ ."usecase/Usuario/SessionManager.php";
  if(isset($_POST["enviar"])) {
    $usuarioController = new UsuarioController();
    $sessionManager = new SessionManager();
    if ($_POST['tipo_acceso'] === 'invitado') {
        $responseUserGues = $usuarioController->iniciarSesion('invitado', 'invitado');
    } else{
        $responseUserGues = $usuarioController->iniciarSesion($_POST['usuario'], $_POST['password']);
    }

    if($responseUserGues->status == 'ok') {
      SessionManager ::startSession();
      $_SESSION["idRol"] = $responseUserGues->body["idRol"];
      if($responseUserGues->body == "") {
        header("Location:views/?cargar=navbar.php");
      }else {
        header("Location:views/viewEmpresa/?cargar=navbar.php");
      }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
        Error al iniciar sesion
        </div>";
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
    
    <form method="POST" action="login.php">
     
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
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }

    function setInvitado(event) {
        // Lógica para el acceso de invitado
    }

    <?php
    if (isset($error)) { 
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