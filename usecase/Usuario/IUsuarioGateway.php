<?php
interface IUsuarioGateway{
    public function InsertarUsuario(Usuario $usuario):int;
    public function ListarUsuarios():array;
    public function ActualizarUsuarios($id, $usuario):bool;

}