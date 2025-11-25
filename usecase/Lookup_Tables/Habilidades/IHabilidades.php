<?php
interface IHabilidades {
    public function listarHabilidades(): array;

    public function insertarHabilidades (Habilidades $habilidades):int;

    /*public function actualizarHabilidades ($id,$postulante):int;

    public function eliminarHabilidades($id) :int;*/

}

/*<?php
interface IEstadoHabilidades{
    
    public function listarEstadoHabilidades():array;
    
}*/