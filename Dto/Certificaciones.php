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
/**
 * CREATE TABLE Certificaciones(
    idCertificacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    organizacionEmisora VARCHAR(45),
    fechaObtencion DATE,
    urlCredencial VARCHAR(100)
);
 */