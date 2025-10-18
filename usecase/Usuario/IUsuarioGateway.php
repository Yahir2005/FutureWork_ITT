<?php
interface IUsuarioGateway{
    public function InsertarUsuario(Usuario $usuario):int;
}