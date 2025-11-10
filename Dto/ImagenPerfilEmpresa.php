<?php
class ImagenPerfilEmpresa{
    private $idImagenEmpresa;
    private $Empresas_idEmpresas;
    private $urlImagenPerfilEmpresa;
    public function __construct(){ 

    }

    public function get($property){
        return $this->$property;
    }
    public function set($property,$value){
        $this->$property = $value;
    }
}