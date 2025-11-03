<?php 

interface IRolGateway {
    public function ListarRoles(): array;
    public function ListarRolPorId($idRol): array;
}