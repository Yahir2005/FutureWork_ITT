<?php
Class TipoContrato{
    private $idTipoContrato;

    private $estadoContrato;

    public function __construct(){
        
    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}