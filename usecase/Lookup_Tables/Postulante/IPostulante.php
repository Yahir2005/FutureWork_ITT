<?php
interface IPostulante{
    public function listarPostulante ():array;
    public function listarPostulantePorNombre($Nombre):array;
    public function insertarPostulante (Postulante $Postulante):int;
    public function actualizarPostulante ($id, $Postulante):int; 
    public function eliminarPostulante ($id):int;
}