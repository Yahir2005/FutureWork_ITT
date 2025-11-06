<?php
class Empresa{
    private $idEmpresa;
    private $nombreEmpresa;
    private $sector;
    private $representante;
    private $descripcion;
    private $sitioWeb;

    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}