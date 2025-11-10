<?php
interface IPostulanteHabilidades{
    public function Insertar(Usuario $usuario):int;
    public function Eliminar():array;
    public function Listar($id, $usuario):bool;
    public function Actualizar($id):bool;

}