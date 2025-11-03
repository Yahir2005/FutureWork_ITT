<?php 

interface IRolGateway {
    public function ListarRoles();
    public function ListarRolPorId($idRol);
}