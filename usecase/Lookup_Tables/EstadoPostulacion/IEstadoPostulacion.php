<?php
interface IEstadoPostulacion{

    public function listarEstadoPostulacion();

    public function listarEstadoPostulacionId(int $id);

    public function insertarEstadoPostulacion(array $data);

    public function actualizarEstadoPostulacion(int $id, array $data);
    
    public function eliminarEstadoPostulacion(int $id);
}



/*<?php
interface IEstadoPostulacion{
    
    public function listarEstadoPostulacion():array;
    
    public function listarEstadoPostulacionId($id): array;
}*/