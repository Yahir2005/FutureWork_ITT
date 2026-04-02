<?php
require_once __DIR__ ."/../../../Dto/ImagenPerfilEmpresa.php";

interface IImagenesPerfilEmpresa{
    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):int;

    public function eliminarImagen($id):int;

    public function obtenerImagenes($id):array;

    public function perfilEmpresa($id):array;
}