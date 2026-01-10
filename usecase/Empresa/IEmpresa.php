<?php
interface IEmpresa {
    public function listarEmpresas():array;

    public function insertarEmpresas(Empresa $empresa):int;

    public function actualizarEmpresas($id, $empresa):int;

    public function eliminarEmpresas($id):int;

    public function buscarEmpresasPorNombre($Nombre):array;

    public function buscarEmpresasPorSector($Sector):array;

    public function buscarEmpresasPorTipoEstado($Tipo):array;

    public function actualizarEstadoEmpresa($id,$empresa):int;

    public function obtenerEmpresaPorIdUsuario($id):array;

}