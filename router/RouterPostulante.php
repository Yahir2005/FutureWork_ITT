<?php
require_once __DIR__ .'/../usecase/Usuario/SessionManager.php';
class RouterPostulante{
    public function CargarVista($vista){
        switch ($vista) {

        case 'login':
            header('Location: /../index.php');
        break;

        case 'AcercaDeNosotrosView':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'navbarPostulante':
            include_once __DIR__ .'/../views/viewPostulante/navbarPostulante.php';
        break;

        case 'Home':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'PerfilPostulanteView':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'EmpresasListView':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'VacantesListView':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'ContactoView':
            include_once __DIR__ .'/../views/viewPostulante/'.$vista.'.php';
        break;

        case 'closeSession':
            SessionManager::destroySession();
            echo "<script> window.location.href='../../index.php';</script>";
        break;

        case 'EXIT':
                
        break;

        default:
            // Redirect to Home for unknown routes
            include_once __DIR__ .'/../views/viewPostulante/Home.php';
        break;
        }
        
    }
    public function validarGET($variable){
        if(!isset($variable) || trim($variable) === ''){
            return false;
        }
        return true;
    }
}