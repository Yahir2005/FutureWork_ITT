<?php
interface IEmpresa {
    public function listarEmpresas():array;

    public function insertarEmpresas(Empresa $empresa):int;
}