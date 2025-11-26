<?php
interface IHabilidades {
    public function listarHabilidades(): array;

    public function insertarHabilidades (habilidades $habilidades):int;

    public function actualizarHabilidades ($id, $habilidades):int;

    public function eliminarHabilidades($id) :int;

}

/*<?php
interface IEstadoHabilidades{
    
    public function listarEstadoHabilidades():array;
    
}*/