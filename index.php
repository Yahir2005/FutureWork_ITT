<?php
    require_once __DIR__ ."/usecase/Usuario/UsuarioController.php";
    require_once __DIR__ ."/usecase/Usuario/SessionManager.php";

    // --- CAMBIO 1: Inicializar la variable de error ---
    $errorMessage = "";

    if(isset($_POST['enviar'])){
        $controller = new UsuarioController();
        $response = $controller->iniciarSesion($_POST['usuario'],$_POST['password']);
        if($response->status == "ok"){
            SessionManager::startSession();
            $_SESSION["idUsuarios"]=$response->body;
            header("Location:views/index.php");
            // --- CAMBIO 2: El 'echo' aquí no se ejecutará por el header(), así que se puede quitar ---
            // echo "<div class='alert alert-success' role='alert'>Inicio de sesión exitoso</div>";
        }else{
            // --- CAMBIO 3: Guardar el error en la variable en lugar de imprimirlo ---
            $errorMessage = "<div class='alert alert-danger' role='alert'>Error al iniciar sesion</div>";
        }
    }
    if(isset($_POST['enviarInvitado'])){
        SessionManager::startSession();
        $_SESSION["idUsuarios"]=0; // ID para usuario invitado
        header("Location:views/index.php");
    }
  
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
     <?php echo $errorMessage; ?>
    </div>
    
    <form method="POST" action="">
     
     <div class="form-group" id="usuarioGroup"><label for="usuario">Correo Electrónico</label> <input type="text" name="usuario" id="usuario" placeholder="Ingresa tu usuario o correo" required>
     </div>
     <div class="form-group password-toggle" id="passwordGroup"><label for="password">Contraseña</label> <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required>
     
      <button type="button" class="toggle-btn" onclick="togglePassword(this)">👁️</button>
     </div>
     <div class="remember-forgot"><label class="remember-me"> <input type="checkbox" name="remember"> <span>Recordarme</span> </label> <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
     </div>
     
     <button type="submit" name="enviar" class="btn-primary"> Iniciar Sesión </button>
     
     <div class="divider"><span>O</span>
     </div>
     
     <button type="submit" name="enviarInvitado" class="btn-guest"> 🌐 Acceder como Invitado </button>
    </form>
    <div class="register-link">
     ¿No tienes cuenta? <a href="views/OpcionUser.php">Regístrate aquí</a>
    </div>
   </div>
  </div>
  <script>
   function togglePassword(button) {
    const passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
     passwordField.type = 'text';
     button.textContent = '🙈'; // Cambia el ícono (opcional)
    } else {
     passwordField.type = 'password';
     button.textContent = '👁️'; // Vuelve al ícono original
    }
   }
  </script>
 </body>
</html>