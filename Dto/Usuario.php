<?php

class Usuario{
    private $idUsuario;
    private $Rol_idRol;
    private $nombreCompleto;
    private $email;
    private $Password;
    private $fechaRegistro;
    
    public function __construct(){

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }

}