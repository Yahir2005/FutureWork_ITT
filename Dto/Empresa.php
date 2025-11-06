<?php
class Empresa{
    private $idEmpresas;
    private $Usuarios_idUsuarios;
    private $EstadoValidacionEmpresa_idEstadoValidacionEmpresa;
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