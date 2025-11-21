<?php
interface IPostulante{
    public function listarPostulante ():array;

    public function insertarPostulante (Postulante $postulante):int;

    public function actualizarPostulante ($id,$postulante):int;

    public function eliminarPostulante($id) :int;
    
    public function listarPostulantePorNombre($Nombre):array;

}