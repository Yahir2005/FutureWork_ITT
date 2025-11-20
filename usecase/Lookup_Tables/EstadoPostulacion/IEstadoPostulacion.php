<?php
interface IEstadoPostulacion{
    
    public function listarEstadoPostulacion():array;
    
    public function listarEstadoPostulacionId($id): array;
}