<?php
class Postulaciones{
    private $idPostulacion;
    private $fechaPostulacion;
    private $Postulante_idInformacionPostulante;
    private $Vacantes_idVacante;
    private $EstadoPostulacion_idEstadoPostulacion;
    
    public function __construct(){
        
    }  
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value){
        $this->$property = $value;
    }
}