<?php
interface IPostulanteCertificacion{

    public function ListarPostulanteCertificacion():array;

    public function InsertarPostulanteCertificacion (PostulanteCertificacion $postulanteCertificacion):int;

    public function ActualizarPostulanteCertificacion ($id, $postulanteCertificacion):int;
    
    public function EliminarPostulanteCertificacion($id):int;
    
}
