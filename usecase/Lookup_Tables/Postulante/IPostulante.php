<?php
interface IPostulante{
    public function listarPostulante ():array;

    /*public function listarPostulantePorNombre ($Nombre):array;*/

    public function insertarPostulante (Postulante $postulante):int;

    

}