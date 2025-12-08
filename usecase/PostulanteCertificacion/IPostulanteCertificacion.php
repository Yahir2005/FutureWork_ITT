<?php
interface IPostulanteCertificacion{

    public function ListarPostulanteCertificacion():array;

    public function insertarPostulanteCertificacion (PostulanteCertificacion $postulanteCertificacion):int;

    public function ActualizarPostulanteCertificacion ($id, $postulanteCertificacion):int;
     
    public function EliminarPostulanteCertificacion($id):int;
     
}