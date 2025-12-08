<?php
class PostulanteCertificacion{
    private $idPostulanteCertificacion;
    private $Postulante_idInformacionPolstulante;
    private $Certificaciones_idCertificacion;


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

