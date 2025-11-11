<?php
require_once __DIR__ .'/../usecase/Usuario/SessionManager.php';

class Router{
    public function CargarVista($vista){
        switch ($vista) {

        case "Inicio":
            include __DIR__ .'/../view/InicioView.php';
        break;

        case 'PerfilPostulante':
            include __DIR__ .'/../view/PerfilPostulanteView.php';
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
}
