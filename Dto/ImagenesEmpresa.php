<?php
class ImagenesEmpresa{
    private $idImagenEmpresa;
    private $Empresas_idEmpresas;
    private $rutaImagenEmpresa;
    private $urlImagen;

    public function __construct(){

    }

    public function get($property){
        return $this->$property;
    }

    public function set($property,$value){
        $this->$property = $value;
    }
}