<?php
  $MessageID = "";
 // muestra el valor
  require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/EstadoValidacionVacante/EstadoValidacionVacanteController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoContrato/TipoContratoController.php";
  require_once __DIR__ . "/../../usecase/Lookup_Tables/TipoModalidad/TipoModalidadController.php";
  require_once __DIR__ . "/../../Dto/Vacantes.php";
  /*Arrays*/
  $listarValidacionVacante = array();
  $listarTipoContrato = array();
  $listarTipoModalidad = array();
  /*Controllers*/
  $usuarioController = new UsuarioController();
  $vacanteController = new VacanteController();
  $vacanteValidacionController = new EstadoValidacionVacanteController();
  $TipoContratoController = new TipoContratoController();
  $TipoModalidadController = new TipoModalidadController();
  /*resultListar */
  $resultListarValidacionVacante = $vacanteValidacionController->listarEstadoValidacionVacante();
  $resultListarTipoContrato = $TipoContratoController->listarTipoContrato();
  $resultListarTipoModalidad = $TipoModalidadController->listarTipoModalidad();

  /**listar */
  if($resultListarValidacionVacante->status == "OK"){
    $listarValidacionVacante = $resultListarValidacionVacante->body;
  }
  if($resultListarTipoContrato->status == "Ok"){
    $listarTipoContrato = $resultListarTipoContrato->body;
  }

  if($resultListarTipoModalidad->status == "ok"){
    $listarTipoModalidad = $resultListarTipoModalidad->body;
  }
  /**Extraer el ID de la empresa*/
  $idUsuario = $_SESSION["idUsuarios"];
    $vacanteId= $_GET['id'];
    $vacante = [];
    $vacanteEditar= $vacanteController->obtenerVacanteporId($vacanteId);
    if($vacanteEditar->status == 'ok'){
        $vacante = $vacanteEditar->body[0];
    }else{
        echo $vacanteEditar->message;
    }


    /**Insertar  */
    if(isset($_POST["EditarVacante"])){
        $vacanteObject = new Vacantes();

        $vacanteObject->set("EstadoValidacionVacante_idEstadoValidacionVacante", $_POST["idEstadoValidacionVacante"]);
        $vacanteObject->set("TipoContrato_idTipoContrato", $_POST["idTipoContrato"]);
        $vacanteObject->set("TipoModalidad_idTipoModalidad", $_POST["idTipoModalidad"]);
        $vacanteObject->set("titulo", $_POST["titulo"]);
        $vacanteObject->set("descripcion", $_POST["descripcion"]);
        $vacanteObject->set("requisitos", $_POST["requisitos"]);
        $vacanteObject->set("ubicacion", $_POST["ubicacion"]);
        $vacanteObject->set("salario", $_POST["salario"]);
        $vacanteObject->set("fechaLimite", $_POST["fechaLimite"]);

        $resultVacante = $vacanteController->ActualizarVacante($vacanteId,$vacanteObject);

        if ($resultVacante->status == 'ok') {
            echo "<div class='alert alert-success' role='alert'>✓ Edicion exitoso</div>";
            $url_destino = 'http://localhost/FutureWork_ITT/views/viewEmpresa/navbarEmpresa.php?cargar=MisVacantesListView'; // Reemplaza esto con tu URL real

    // Especifica el retraso en segundos
    $retraso_segundos = 3;

    // Envía la cabecera de redirección meta refresh
    header("Refresh: $retraso_segundos; URL=$url_destino");
        } else {
            echo "<div class='alert alert-danger' role='alert'>✗ Error al editar: ".$resultVacante->message."</div>";
        }
    }
?>

