<?php
    require_once __DIR__ ."/usecase/Usuario/UsuarioController.php";
    require_once __DIR__ ."/usecase/Usuario/SessionManager.php";
    include_once("router/RouterEmpresa.php");
    include_once("router/RouterPostulante.php");
    $usuariosList = array();
    
    $errorMessage = "";
    
    if(isset($_POST['enviar'])){
        $controller = new UsuarioController();
        
        $response = $controller->iniciarSesion($_POST['usuario'],$_POST['password']);
        
        if($response->status == "ok"){
            SessionManager::startSession();
            
            $_SESSION["idUsuarios"] = $response->body['idUsuarios'];
            $_SESSION["Rol_idRol"] = $response->body['Rol_idRol'];
            $result = $controller->obtenerEntidadPorUsuario($response->body['idUsuarios']);
            
            switch($_SESSION['Rol_idRol']){
                case 1: // Empresa
                    $_SESSION["idEmpresas"] = $result->body['empresaId']; // usa la clave correcta
                    header("Location:views/viewEmpresa/navbarEmpresa.php?cargar=Home");  
                    break;

                case 2: // Postulante
                    $_SESSION["idPostulante"] = $result->body['postulanteId']; // usa la clave correcta
                    header("Location:views/viewPostulante/navbarPostulante.php?cargar=Home");
                    break;

                default:
                    $errorMessage = "<div class='alert alert-danger' role='alert'>Error: Rol de usuario no reconocido.</div>";
                    break;
            }

            exit();
        } else {
            // Usamos el mensaje de error que viene desde el UseCase
            $errorMessage = "<div class='alert alert-danger' role='alert'>".$response->message."</div>";
        }
    }

    if(isset($_POST['enviarInvitado'])){
        SessionManager::startSession();
        $_SESSION["idUsuarios"] = 0;
        $_SESSION["Rol_idRol"] = 0;
        header("Location: views/navbar.php");
        exit();
    }
?>
<!doctype html>
<!-- El resto del HTML no cambia -->
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
     <div class="form-group password-toggle" id="passwordGroup"><label for="password">Contraseña</label> <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required="">
     
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