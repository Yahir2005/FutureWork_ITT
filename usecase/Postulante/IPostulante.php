<?php
interface IPostulante {
    
    // Inserta un nuevo postulante y devuelve el ID generado o el número de filas afectadas
    public function insertarPostulante(Postulante $postulante): int;

    // Obtiene los datos de un postulante específico por su ID de usuario (el que viene de la sesión)
    public function obtenerPostulantePorIdUsuario(int $idUsuario);

    // Actualiza la información del perfil (teléfono, ubicación, etc.)
    public function actualizarPostulante(Postulante $postulante): bool;

    // Específicamente para actualizar la ruta del archivo CV
    public function actualizarCV(int $idPostulante, string $nuevoPath): bool;

    // Para mostrar la lista de postulantes (si hubiera un panel de admin)
    public function listarPostulantes(): array;
}