<?php
  require_once __DIR__ . "/usecase/Usuario/SessionManager.php";
  $sessionManager = new SessionManager(); // <-- CORRECCIÓN: Instanciar la clase
  $sessionManager->startSession();     // <-- CORRECCIÓN: Llamar método desde el objeto

  require_once __DIR__ ."/usecase/Lookup_Tables/Rol/RolController.php";
  $controllerRol = new RolController();
  $resultRol = $controllerRol->ListarRoles();
  $listarRol= array();
  if($resultRol->status=='ok'){
		$listarRol = $resultRol->body;
	}else{  
    $error = "Error al listar los roles.";
	}

  require_once __DIR__ . "/usecase/Usuario/UsuarioController.php";
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
      $usuario = $_POST['usuario'];
      $password = $_POST['password'];
      $idRol = $_POST['Rol']; 

      $controller = new UsuarioController();
      $resultado = $controller->iniciarSesion($usuario, $password, $idRol);

      if ($resultado->status === 'ok') {
          $sessionManager->crearSesion($resultado->body); // <-- CORRECCIÓN: Llamar método desde el objeto
          header("Location: views/home.php");
          exit();
      } else {
          $error = $resultado->message;
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
     <div class="form-group"><label for="tipo_acceso">Tipo de Acceso</label>
     				<select 
					required
					name="Rol" 
					class="form-select form-select-sm mb-4" 
					aria-label=".form-select-lg example">
                    
					<option value="">Seleccione un Tipo</option>
					<?php
					foreach ($listarRol as $row) {
						echo "<option value='" . ($row['idRol']) . "'>" . $row['nombreRol'] . "</option>";
					}
					?>
				</select>
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