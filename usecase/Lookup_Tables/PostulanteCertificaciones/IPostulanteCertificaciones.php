<?php
interface IPostulanteCertificaciones{
    
    public function listarPostulanteCertificaciones():array;
    
    public function insertarPostulanteCertificaciones (Postulante $postulante):int;

    public function actualizarPostulanteCertificaciones ($id,$postulante):int;

    public function eliminarPostulanteCertificaciones($id) :int;
    
}