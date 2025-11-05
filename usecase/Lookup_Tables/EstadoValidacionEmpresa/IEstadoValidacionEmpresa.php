<?php

interface IEstadoValidacionEmpresa {

    public function ListarValidacionesEmpresa():array;

    public function ListarValidacionesEmpresaId($id):array;

}