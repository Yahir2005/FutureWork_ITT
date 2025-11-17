<?php
interface IUsuarioGateway{
    public function InsertarUsuario(Usuario $usuario):int;
    public function ListarUsuarios():array;
    public function ActualizarUsuarios($id, $usuario):bool;
    public function DeleteUsuario($id):bool;
    public function iniciarSesion(string $usuario, string $contrasena):array;
    public function obtenerUsuarioPorId($id):array;
    public function obtenerIdRolUsuarios($id):array;
}