<?php
interface IPostulantes {
    public function InsertarPostulante(Postulante $postulante): int;
    public function ListarPostulantes(): array;
    public function ActualizarPostulante($id, Postulante $postulante): int;
    public function EliminarPostulante($id): int;
    public function ObtenerPostulantePorIdUsuario($id): array;
}