<?php
class Rol{
    private $idRol;
    private $nombreRol;

    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}