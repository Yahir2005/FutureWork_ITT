<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IHabilidades.php";

class HabilidadesGateway implements IHabilidades{

    public function listarHabilidades():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM Habilidades";
        $result = $objSQL->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function insertarHabilidades(Habilidades $habilidades): int {
        $objSQL = new MysqlConnector();
        $sql = "INSERT INTO Habilidades (nombreHabilidad) 
        VALUES ('{$habilidades->get('nombreHabilidad')}')";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }

    public function ActualizarHabilidades($id, $habilidades): int {
        $objSQL = new MysqlConnector();
        $sql = "UPDATE Habilidades SET 
            nombreHabilidad = '{$habilidades->get('nombreHabilidad')}'
        WHERE idHabilidades = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }

    public function EliminarHabilidades($id): int {
        $objSQL = new MysqlConnector();
        $sql = "DELETE FROM Habilidades WHERE idHabilidades = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }
}

