<?php
class ImagenesPerfilPostulante{
    private $idImagenPostulante;
    private $Postulante_idPostulante ;
    private $urlImagenPerfilPostulante;

    public function __construct(){

    }

    public function get($property){
        return $this->$property;
    }

    public function set($property,$value){
        $this->$property = $value;
    }
}
