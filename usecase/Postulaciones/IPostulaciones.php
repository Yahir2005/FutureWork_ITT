<?php
interface IPostulaciones{
    public function listarPorNombre(Postulaciones $postulacion):int;
    public function listar ();
    public function insertar();
    public function actualizar();
    public function eliminar();
}