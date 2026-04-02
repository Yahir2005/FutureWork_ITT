<?php
require_once __DIR__ ."/../../../Dto/ImagenesPostulante.php";

interface IImagenesPostulante{
    public function InsertarImagenPostulante(ImagenesPostulante $imagenesPostulante):int;

    public function eliminarImagen($id):int;

    public function obtenerImagenes():array;

}