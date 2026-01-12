<?php
require_once __DIR__ .'/../usecase/Usuario/SessionManager.php';

class RouterEmpresa{
    public function CargarVista($vista){
        switch ($vista) {

        case 'login':
            header('Location: /../index.php');
        break;

        case "navbarEmpresa":
            include_once __DIR__ . ('/../views/viewEmpresa/navbarEmpresa.php');
        break;
        
        case 'VacantesView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'Home':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'VacantesListView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'EmpresasMenuView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;
        
        case 'AcercaDeNosotrosView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'ContactoView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'VacantesAddView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'MisVacantesListView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'EmpresasListView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'VacantesUpdateView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'PerfilEmpresaView':
            include_once __DIR__ .('/../views/viewEmpresa/'. $vista .'.php');
        break;

        case 'closeSession':
            SessionManager::destroySession();
            echo "<script> window.location.href='../../index.php';</script>";
                    //header("Location:../index.php");
                    //exit();
        break;

        case 'ṔerfilEmpresa':
            include __DIR__ .'';
        break;

        case "Ver_Vacantes_Empresa":
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

        case "Ver_Postulantes_Vacante":
            include __DIR__ .'/../view/VerPostulantesVacanteView.php';
        break;
        
        case "Perfil_Empresa_Usuario":
            include __DIR__ .'/../view/PerfilEmpresaView.php';
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
