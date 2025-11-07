<?php
class EstadoPostulacion{
    
    private $idEstadoPostulacion;
    private $estadoPostulacion;

    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}