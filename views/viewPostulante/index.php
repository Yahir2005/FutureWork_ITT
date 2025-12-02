<?php
    include_once __DIR__ ."/../../router/RouterPostulante.php";
    include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: ../../index.php");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Postulante</title>
  <link rel="stylesheet" href="../css/navbar.css">
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <?php
    // Include the navbar partial
    include_once __DIR__ . "/navbarPostulante.php";
  ?>
  
  <main>
    <section>
      <?php
        $enrutador = new RouterPostulante();
        if(isset($_GET['cargar'])){
          if($enrutador->validarGET($_GET['cargar'])){
            $enrutador->cargarVista($_GET['cargar']);
          } else {
            // If validation fails, show Home
            $enrutador->cargarVista('Home');
          }
        } else {
          // Default to Home if no parameter
          $enrutador->cargarVista('Home');
        }
      ?>
    </section>
  </main>
 </body>
</html>
