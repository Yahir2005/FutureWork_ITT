<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/ICarrera.php";

class CarreraGateway implements ICarrera  {
    public function listarCarrera(): array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Carrera";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function listarCarreraPorId($idCarrera): array{
        $result = [];
        try {
            $mysqlObj = new MysqlConnector();
            $query = "SELECT * FROM carrera WHERE idCarrera =".$idCarrera;
            $result = $mysqlObj->consultaRetorno($query);
            if($result!=false){
                $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                throw new Exception("Error al obtener la Carrera");
            }
        } catch (Exception $e) {
            throw new Exception("Error al obtener la carrera: ".$e->getMessage());
        }
        return $result;
    }
}