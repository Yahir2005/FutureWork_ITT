<?php
class EstadoValidacionVacante{
    public $idEstadoValidacionVacante;
    public $estadoValidacionVacante;

    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}
