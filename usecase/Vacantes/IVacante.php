<?php
interface IVacante{
    public function InsertarVacante(Vacantes $vacantes):int;

    public function ActualizarVacante($id, $vacantes):int;

    public function EliminarVacante($id):int;

    public function ListarVacantes():array;

    public function ListarVacantesPorNombre($nombre):array;

    public function ListarVacantesPorEmpresa($idEmpresa):array;
}