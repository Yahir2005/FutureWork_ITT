<?php
require_once __DIR__ . '/IEstadoPostulacion.php';

class EstadoPostulacionGateway implements IEstadoPostulacion{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listarEstadoPostulacion() {
        $sql = "SELECT id, nombre, descripcion FROM EstadoPostulacion ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarEstadoPostulacionId(int $id) {
        $sql = "SELECT id, nombre, descripcion FROM EstadoPostulacion WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarEstadoPostulacion(array $data) {
        $sql = "INSERT INTO EstadoPostulacion (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nombre', $data['nombre']);
        $stmt->bindValue(':descripcion', $data['descripcion'] ?? null);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function actualizarEstadoPostulacion(int $id, array $data) {
        $sql = "UPDATE EstadoPostulacion SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nombre', $data['nombre']);
        $stmt->bindValue(':descripcion', $data['descripcion'] ?? null);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarEstadoPostulacion(int $id) {
        $sql = "DELETE FROM EstadoPostulacion WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

/*<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IEstadoPostulacion.php";

class EstadoPostulacionGateway implements IEstadoPostulacion{

     public function listarEstadoPostulacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM EstadoPostulacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }
}*/