<?php
interface IHabilidades {
    public function listarHabilidades(): array;

    public function insertarHabilidades (Habilidades $habilidades):int;

    public function actualizarHabilidades ($id, $habilidades):int;

    public function eliminarHabilidades($id) :int;

}
