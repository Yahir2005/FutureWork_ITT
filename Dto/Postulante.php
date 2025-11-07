<?php
class Postulante {
    private $idPostulante;
    private $Carrera_idCarrera;
    private $Usuarios_idUsuarios;
    private $numeroControl;
    private $cvPath;
    private $telefono;
    private $ubicacion;	

    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }

}