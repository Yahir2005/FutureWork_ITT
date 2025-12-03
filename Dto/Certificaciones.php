<?php
class Certificaciones{
    private $idCertificacion;
    private $nombre;
    private $organizacionEmisora;
    private $fechaObtencion;
    private $urlCredencial;

    public function __construct(){
        
    }

    public function get($property){
        return $this->$property;
    }

    public function set( $property, $value ){
        $this->$property = $value;
    }

}