<?php
interface IVacante{
    public function InsertarVacante(Vacantes $vacantes):int;

    public function ActualizarVacante($id, $vacantes):int;

    public function EliminarVacante($id):int;

    public function ListarVacantes():array;

    public function ListarVacantesPorNombre($nombre):array;

    public function ListarVacantesPorEmpresa($idEmpresa):array;

    public function ListarVacantesPorEstadoEmpresaContrato($idEstado):array;

    public function ContarCandidatosPorVacante($idVacante): int;

    public function contarVacantes():int;
    public function contarVacantesAbiertas():int;
    public function contarVacantesCerradas():int;
    public function contarVacantesPausadas():int;

    public function ListarVacantesTotalesCard():array;

        
}