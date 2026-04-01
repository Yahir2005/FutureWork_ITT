<?php

class ImagenEmpresaPerfil {
    private $idImagenEmpresaPerfil;
    private $Nombre;
    private $rutaImagenPerfilEmpresa;

    public function __construct() {

    }
    public function get($property){
        return $this->$property;
    }
    public function set($property,$value){
        $this->$property = $value;
    }
}
/*
CREATE TABLE ImagenEmpresaPerfil(
    idImagenEmpresaPerfil INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    rutaImagenPerfilEmpresa VARCHAR(255),
    FOREIGN KEY (Empresas_idEmpresas) REFERENCES Empresas(idEmpresas)
);
 */