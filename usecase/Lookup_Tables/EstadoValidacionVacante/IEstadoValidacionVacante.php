<?php

interface IEstadoValidacionVacante {

    public function ListarEstadoValidacionVacante():array;

    public function ListarEstadoValidacionVacantePorId($idEstado):array;

}