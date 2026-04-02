<?php
require_once __DIR__ .'/../usecase/Usuario/SessionManager.php';

class RouterPostulante{
    public function CargarVista($vista){
        switch ($vista) {

        case 'login':
            header('Location: /../index.php');
        break;

        case 'AcercaDeNosotrosView':
            include_once __DIR__ .('/../views/viewPostulante/'.$vista.".php");
        break;

        case "navbarPostulante":
            include_once __DIR__ . ('/../views/Postulante/'.$vista.".php");
        break;

        case "Home":
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case 'PerfilPostulanteView':
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case 'EmpresasListView':
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case 'VacantesListView':
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case 'ContactoView':
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case 'PostularseView':
            include __DIR__ .('/../views/Postulante/'.$vista.'.php');
        break;

        case "Ver_Vacantes":
            include __DIR__ .'/../views/Postulante/InicioView.php';
        break;

        case "Ver_Postulantes":
            include __DIR__ .'/../views/Postulante/VerPostulantesView.php';
        break;

        case "Ver_Vacante":
            include __DIR__ .'/../views/Postulante/VerVacanteView.php';
        break;

        case "Ver_Contacto":
            include __DIR__ .'/../views/Postulante/InicioView.php';
        break;

        case "closeSession":
                SessionManager::destroySession();
            echo "<script> window.location.href='../../index.php';</script>";
                    //header("Location:../index.php");
                    //exit();
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