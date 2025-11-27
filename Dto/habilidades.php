<?php
class habilidades{
    private $idHabilidad;
    private $nombreHabilidad;

    public function __construct()
    {
    
    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    } 
}

