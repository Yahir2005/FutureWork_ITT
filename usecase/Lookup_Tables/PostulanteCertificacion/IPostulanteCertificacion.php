<?php
interface IPostulanteCertificacion{
    
    public function listarPostulanteCertificacion():array;
    
    public function insertarPostulanteCertificacion (PostulanteCertificacion $postulanteCertificacion):int;

    public function actualizarPostulanteCertificacion ($id,$postulanteCertificacion):int;

    public function eliminarPostulanteCertificacion($id) :int;
    
}