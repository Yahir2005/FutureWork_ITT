<?php
    include_once __DIR__ ."/../../router/RouterPostulante.php";
    include_once __DIR__ ."/../../usecase/Usuario/SessionManager.php";

    if(!SessionManager::isUserLoggedIn()){
      header("Location: ../../index.php");
      exit();
    }

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
