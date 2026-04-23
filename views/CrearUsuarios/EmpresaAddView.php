<?php
    $mensaje = "";
    $detalleMensaje = "";
    
    // Direcciones
    require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";
    require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
    require_once __DIR__ . "/../../usecase/Files/EmpresaImagenPerfil/ImagenEmpresaPerfilController.php";
    require_once __DIR__ ."/../../usecase/Files/ImagenPerfilEmpresa/ImagenesPerfilEmpresaController.php";
    
    require_once __DIR__ ."/../../Dto/EmpresaImagenPerfil.php";
    require_once __DIR__ ."/../../Dto/ImagenPerfilEmpresa.php";
    require_once __DIR__ . "/../../Dto/Empresa.php";
    require_once __DIR__ . "/../../Dto/Usuario.php";

    /** Controllers */
    $controllerUsuario = new UsuarioController();
    $controllerEmpresa = new EmpresaController();
    $controllerImagenEmpresaPerfil = new ImagenEmpresaPerfilController();
    $controllerEmpresaImagenPerfil = new ImagenesPerfilEmpresaController();
    
    $imagenObj = new EmpresaImagenPerfil();
    $empresaImagenPerfilObj = new ImagenPerfilEmpresa();
    $empresa = new Empresa();
    $usuarioObj = new Usuario();

    if (isset($_POST["enviar"])) {
        $password = $_POST["password"] ?? "";
        $confirmPassword = $_POST["confirmPassword"] ?? "";

        if ($password !== $confirmPassword) {
            $mensaje = "error_password";
        } else {
            // 1. Configurar Usuario
            $usuarioObj->set("Rol_idRol", 1);
            $usuarioObj->set("nombreCompleto", $_POST["nombreCompleto"]);
            $usuarioObj->set("email", $_POST["email"]);
            $usuarioObj->set("Password", $password);

            // 2. Insertar Usuario
            $resultUsuario = $controllerUsuario->InsertarUsuario($usuarioObj);
            if ($resultUsuario->status === "ok" && !empty($resultUsuario->body)) {
                $usuarioId = (int)$resultUsuario->body;

                // 3. Configurar Empresa con el ID del usuario creado
                $empresa->set("Usuarios_idUsuarios", $usuarioId);
                $empresa->set("EstadoValidacionEmpresa_idEstadoValidacionEmpresa", 1);
                $empresa->set("nombreEmpresa", $_POST["nombreEmpresa"]);
                $empresa->set("sector", $_POST["sector"]);
                $empresa->set("representante", $_POST["representante"]);
                $empresa->set("descripcion", $_POST["descripcion"]);
                $empresa->set("sitioWeb", $_POST["sitioWeb"]);

                $resultEmpresa = $controllerEmpresa->insertarEmpresas($empresa);
                
                
                if ($resultEmpresa->status === "ok") {
                    $empresaIdResponse = $controllerEmpresa->obtenerUltimaEmpresaId();
                    $empresaId = !empty($empresaIdResponse->body) ? (int)$empresaIdResponse->body : 0;
                    $mensaje = "success";
                    //enviar
                    // 4. Lógica de Imagen (Usando las 2 tablas) = Registrar imagen de perfil de la empresa
                    if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0 && is_uploaded_file($_FILES["imagen"]["tmp_name"])){
                        $nombreImg = $_FILES["imagen"]["name"];
                        $ruta = $_FILES["imagen"]["tmp_name"];
                        $tipoImagen = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
                        $nombreImg = time() . "_" . basename($_FILES["imagen"]["name"]);
                        $destino = __DIR__ . "/../Files/ImagenesEmpresa/" . $nombreImg;
                        if($tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "jpg"){
                            if(move_uploaded_file($ruta,$destino)){
                                $rutaBD = "views/Files/ImagenesEmpresa/" . $nombreImg;
                                $imagenObj->set("rutaImagenPerfilEmpresa", $rutaBD);
                                $imagenObj->set("Nombre",$nombreImg);
                                $resultImagen=$controllerImagenEmpresaPerfil->subirImagenPerfilEmpresa($imagenObj);
                                $imagenId = $resultImagen->body;

                                $empresaImagenPerfilObj->set("Empresas_idEmpresas", $empresaId);
                                $empresaImagenPerfilObj->set("EmpresaPerfilImagen_idEmpresaPerfilImagen", $imagenId);

                                $resultRelacion = $controllerEmpresaImagenPerfil->InsertarImagenPerfilEmpresa($empresaImagenPerfilObj);

                                if($resultImagen->status == "ok"){
                                    echo "<div class='alert alert-success' role='alert'> Registro exitoso</div>";
                                }else{
                                    echo "<div class='alert alert-danger' role='alert'>
                                    Error al registrar ".$resultImagen->message."
                                    </div>";
                                }
                            }
                        }else{
                            echo "<div class='alert alert-danger' role='alert'>
                            No se acepta ese formato
                            </div>";
                        }
                    }
                } else {
                    $mensaje = "error_empresa";
                }
                
                
            } else {
                $mensaje = "error_usuario";
            }
        }
    }
?>
<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Registro de Empresa</title>
  <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 40px 20px; }
      .form-container { background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); max-width: 700px; width: 100%; overflow: hidden; }
      .form-header { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 40px 30px; text-align: center; }
      .form-header h1 { font-size: 32px; margin-bottom: 10px; font-weight: 700; }
      .form-body { padding: 40px 30px; }
      .section-title { color: #2c3e50; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 2px solid #e9ecef; padding-bottom: 10px; }
      .form-group { margin-bottom: 25px; }
      .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
      .form-label { color: #2c3e50; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block; }
      .form-label .required { color: #dc3545; }
      .form-input, .form-select, .form-textarea { width: 100%; padding: 12px 15px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 15px; }
      .btn-submit { width: 100%; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-weight: 700; font-size: 16px; cursor: pointer; margin-top: 10px; }
      .btn-submit:hover { transform: translateY(-2px); }
      .error-message { color: #dc3545; font-size: 13px; margin-top: 5px; display: none; }
      .error-message.show { display: block; }
      .password-wrapper { position: relative; }
      .password-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; }
      
      .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; text-align: center; font-weight: bold; }
      .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
      .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
      
      @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
  </style>
 </head>
 <body>
  <div class="form-container">
   <div class="form-header">
    <h1>🏢 Registro de Empresa</h1>
    <p>Únete a FutureWork ITT y encuentra el mejor talento</p>
   </div>
   
   <div class="form-body">
       <?php if($mensaje == "success"): ?>
            <div class="alert alert-success" id="successMessage">
                ✅ ¡Registro completado con éxito! Tu empresa está en validación.
            </div>
      <?php elseif($mensaje == "warning_imagen"): ?>
          <div class="alert alert-error">⚠️ <?php echo htmlspecialchars($detalleMensaje); ?></div>
      <?php elseif($mensaje == "error_password"): ?>
          <div class="alert alert-error">❌ Las contraseñas no coinciden.</div>
       <?php elseif($mensaje == "error_empresa"): ?>
            <div class="alert alert-error">❌ Error al guardar los datos de la empresa.</div>
       <?php elseif($mensaje == "error_usuario"): ?>
            <div class="alert alert-error">❌ Error al crear el usuario. Posiblemente el correo ya existe.</div>
       <?php endif; ?>

      <form action="" method="POST" enctype="multipart/form-data" id="empresaForm">
         <h3 class="section-title">👤 Datos de Acceso</h3>
         <div class="form-row">
          <div class="form-group"><label for="nombreCompleto" class="form-label"> Nombre Completo <span class="required">*</span> </label> <input type="text" id="nombreCompleto" name="nombreCompleto" class="form-input" placeholder="Ej: Juan Pérez García" maxlength="45" required> <span class="error-message" id="errorNombreCompleto"></span>
          </div>
          <div class="form-group"><label for="email" class="form-label"> Correo Electrónico <span class="required">*</span> </label> <input type="email" id="email" name="email" class="form-input" placeholder="empresa@ejemplo.com" maxlength="45" required> <span class="error-message" id="errorEmail"></span>
          </div>
         </div>
         <div class="form-row">
          <div class="form-group"><label for="password" class="form-label"> Contraseña <span class="required">*</span> </label>
           <div class="password-wrapper"><input type="password" id="password" name="password" class="form-input" placeholder="••••••••" maxlength="50" required> <button type="button" class="password-toggle" onclick="togglePassword('password')">👁️</button>
           </div><span class="form-help">Mínimo 8 caracteres</span> <span class="error-message" id="errorPassword"></span>
          </div>
          <div class="form-group"><label for="confirmPassword" class="form-label"> Confirmar Contraseña <span class="required">*</span> </label>
           <div class="password-wrapper"><input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="••••••••" maxlength="50" required> <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">👁️</button>
           </div><span class="error-message" id="errorConfirmPassword"></span>
          </div>
         </div>
         
         <input type="hidden" name="Rol_idRol" value="1">

         <h3 class="section-title" style="margin-top: 30px;">🏢 Información de la Empresa</h3>
         <div class="form-group"><label for="nombreEmpresa" class="form-label"> Nombre de la Empresa <span class="required">*</span> </label> <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="form-input" placeholder="Ej: Tecnología Avanzada S.A. de C.V." maxlength="45" required> <span class="error-message" id="errorNombreEmpresa"></span>
         </div>
         <div class="form-row">
          <div class="form-group"><label for="sector" class="form-label"> Sector <span class="required">*</span> </label> <select id="sector" name="sector" class="form-select" required> <option value="">-- Selecciona el sector --</option> <option value="Tecnología">Tecnología</option> <option value="Manufactura">Manufactura</option> <option value="Automotriz">Automotriz</option> <option value="Aeroespacial">Aeroespacial</option> <option value="Electrónica">Electrónica</option> <option value="Logística">Logística</option> <option value="Consultoría">Consultoría</option> <option value="Construcción">Construcción</option> <option value="Retail">Retail</option> <option value="Servicios">Servicios</option> <option value="Otro">Otro</option> </select> <span class="error-message" id="errorSector"></span>
          </div>
          <div class="form-group"><label for="representante" class="form-label"> Representante Legal <span class="required">*</span> </label> <input type="text" id="representante" name="representante" class="form-input" placeholder="Ej: María González López" maxlength="45" required> <span class="error-message" id="errorRepresentante"></span>
          </div>
         </div>
         <div class="form-group"><label for="sitioWeb" class="form-label"> Sitio Web </label> <input type="url" id="sitioWeb" name="sitioWeb" class="form-input" placeholder="https://www.ejemplo.com" maxlength="45"> <span class="form-help">Opcional</span> <span class="error-message" id="errorSitioWeb"></span>
         </div>
         <div class="form-group"><label for="descripcion" class="form-label"> Descripción de la Empresa <span class="required">*</span> </label> <textarea id="descripcion" name="descripcion" class="form-textarea" placeholder="Describe brevemente tu empresa..." required></textarea> <span class="error-message" id="errorDescripcion"></span>
         </div>

        <h3 class="section-title" style="margin-top: 30px;">📷 Registrar Imagen</h3>
        <div class="form-group">
            <label for="imagen" class="form-label"> Imagen de perfil </label>
            <input type="file" id="imagen" class="form-input" name="imagen" accept=".jpg,.jpeg,.png">
            <span class="form-help">Opcional</span>
        </div>
         <div class="form-actions">
             <button type="submit" name="enviar" class="btn-submit"> ✅ Registrar Empresa </button>
         </div>
       </form>
   </div>
  </div>

  <script>
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const button = input.nextElementSibling;
      if (input.type === 'password') {
        input.type = 'text'; button.textContent = '🙈';
      } else {
        input.type = 'password'; button.textContent = '👁️';
      }
    }
/*
    document.getElementById('empresaForm').addEventListener('submit', function(e) {
      document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
      let hasError = false;

      if (document.getElementById('nombreCompleto').value.trim().length === 0) hasError = true;
      if (document.getElementById('password').value.length < 8) hasError = true;
      if (document.getElementById('password').value !== document.getElementById('confirmPassword').value) hasError = true;
      
      if (hasError) {
        e.preventDefault(); // Detiene el envío si la validación falla
        return;
      }
    });*/
  </script>
 </body>
</html>