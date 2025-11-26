<?php
class PostulanteCertificacion{
    private $postulante_idPostulante;
    private $certificaciones_idCertificacion;


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

