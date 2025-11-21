<?php
class RouterPostulante{
    public function CargarVista($vista){
        switch ($vista) {

        case 'login':
            header('Location: /../index.php');
        break;

        case "Home":
            include __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'PerfilPostulanteView':
            include __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'ṔerfilEmpresa':
            include __DIR__ .'';
        break;

        case "Ver_Vacantes":
            include __DIR__ .'/../view/InicioView.php';
        break;

        case "Ver_Postulantes":
            include __DIR__ .'/../view/VerPostulantesView.php';
        break;

        case "Ver_Vacante":
            include __DIR__ .'/../view/VerVacanteView.php';
        break;

        case "Ver_Contacto":
            include __DIR__ .'/../view/InicioView.php';
        break;

        case "EXIT":
                
        break;
        }
        
    }
     public function validarGET($variable){
            if(empty($variable)){
                echo "<script> window.history.back();</script>";
            } else{
                return true;
            }
    }
}