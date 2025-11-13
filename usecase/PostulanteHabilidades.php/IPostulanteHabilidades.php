<?php
interface IPostulanteHabilidades{
    public function InsertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):int;
    public function EliminarPostulanteHabilidades($id):int;
    public function ListarPostulanteHabilidades():array;
    public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):int;

}