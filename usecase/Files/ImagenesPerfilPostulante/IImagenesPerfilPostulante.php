<?php
interface IImagenesPerfilPostulante{
    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):int;

    public function EliminarImagenPerfilPostulante($id):int;

    public function MostrarImagenPerfilPostulante($id):array;
}