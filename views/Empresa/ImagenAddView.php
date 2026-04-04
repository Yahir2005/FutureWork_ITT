<?php

    require_once __DIR__ . "/../../usecase/Files/EmpresaImagenPerfil/ImagenEmpresaPerfilController.php";
    require_once __DIR__ ."/../../usecase/Files/ImagenPerfilEmpresa/ImagenesPerfilEmpresaController.php";
    
    require_once __DIR__ ."/../../Dto/EmpresaImagenPerfil.php";
    require_once __DIR__ ."/../../Dto/ImagenPerfilEmpresa.php";
    
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
            if (isset($_FILES['imagen'])) {  
                $nombreImg = $_FILES['imagen']['name'];  
                $ruta      = $_FILES['imagen']['tmp_name']; 
                $tipoImagen = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION)); 
                $destino   = "archivos/" . $nombreImg;
                if ($tipoImagen == "jpeg" || $tipoImagen == "png") {
                    if (move_uploaded_file($ruta, $destino)) {
                        $imagenObj->set('Ruta',$destino);
                        $imagenObj->set('Nombre',$nombreImg);
                        $result=$controller->RegistrarImagen($imagenObj);
                    if ($result->status == 'ok') {  
                        echo "<div class='alert alert-success' role='alert'> Registro exitoso
                    </div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>
                        Error al registrar".$result->message;" 
                        </div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                        No se acepta ese formato 
                        </div>";
            }
           
        }        
    }
    

?>
<div class="container text-left">
    <div class="p-3 m-0 border-0 bd-example m-0 border-0"> 
        <h3>Registrar Imagen</h3>
        <div class="modal-body">
            <form action="" enctype="multipart/form-data" method="POST">
                    <input type="file" class="form-control" name="imagen"> 
                <button type="submit" name="enviar" class="btn btn-primary mt-3">Guardar Imagen</button>
           </form>
        </div>
    </div>
</div>

