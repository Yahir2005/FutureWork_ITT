<?php
class Postulaciones{
    private $idPostulacion;
    private $Postulante_idPostulante;
    private $Vacantes_idVacante;
    private $EstadoPostulacion_idEstadoPostulacion;
    private $fechaPostulacion;
    
    public function __construct(){
        
    }  
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value){
        $this->$property = $value;
    }
}