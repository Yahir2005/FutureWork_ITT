<?php

require_once __DIR__ . "/usecase/Usuario/UsuarioController.php";
require_once __DIR__ . "/usecase/Usuario/SessionManager.php";


if (isset($_POST['enviar'])) {
  $controllerUsuario = new UsuarioController();
  $response = null;
  if ($_POST['tipo_acceso'] === 'invitado') {
    $response = $controllerUsuario->iniciarSesion("invitado", "invitado");
  } else {
    $response = $controllerUsuario->iniciarSesion($_POST['usuario'], $_POST['password']);
  }

  if ($response->status == "ok") {
    SessionManager::startSession();
    $_SESSION["idUsuarios"] = $response->body["idUsuarios"];
    $_SESSION["estudianteId"] = $response->body["EstudianteId"];
    header("Location:viewsStudent/?cargar=StudentTestListView");
  } else {
    echo "Usuario o contraseña incorrecta";
  }
}
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const tipoAccesoSelect = document.querySelector('select[name="tipo_acceso"]');
    const usuarioInput = document.querySelector('input[name="usuario"]').parentElement;
    const passInput = document.querySelector('input[name="password"]').parentElement;

    tipoAccesoSelect.addEventListener('change', function() {
      if (this.value === 'invitado') {
        usuarioInput.style.display = 'none';
        passInput.style.display = 'none';
        document.querySelector('button[name="enviar"][value="invitadoLogin"]').click();
        document.querySelector('button[name="enviarInvitado"]').classList.remove('d-none');
      } else {
        usuarioInput.style.display = 'block';
        passInput.style.display = 'block';
      }
    });
  });
</script>
<!DOCTYPE html>
<html>

<head>
  <title>FutureWork ITT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="mystyle.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="test.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="post">


          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Quiz Software</p>
          </div>

          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Selecciona un rol</label>
            <select name="tipo_acceso" class="form-control form-control-lg">
              <option value="usuario" selected>Usuario</option>
              <option value="invitado">Invitado</option>
            </select>

          </div>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="usuario" class="form-control form-control-lg"
              placeholder="Ingrese un usuario" />
            <label class="form-label" for="form3Example3">Usuario</label>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password" name="password" class="form-control form-control-lg"
              placeholder="Ingrese una contraseña" />
            <label class="form-label" for="password">Password</label>
          </div>
          <div>
            Si no tienes un usuario selecciona el rol invitado
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button data-mdb-button-init data-mdb-ripple-init
              class="btn btn-primary btn-lg"
              name="enviar" value="enviar"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar</button>
            <button data-mdb-button-init data-mdb-ripple-init
              class="btn btn-primary btn-lg d-none"
              name="enviarInvitado" value="invitado"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Invitado</button>
            <p></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>