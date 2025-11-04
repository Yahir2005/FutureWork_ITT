<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IEstadoValidacionVacante.php";

class EstadoValidacionVacanteUseCaseGateway implements IEstadoValidacionVacante {


    public function ListarEstadoValidacionVacante(): array {
        $mysqlConnector = new MysqlConnector();
        $query = "SELECT * FROM EstadoValidacionVacante";
        $result = $mysqlConnector->consultaRetorno($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarEstadoValidacionVacantePorId($idEstado): array {
       $result = [];
        try {
            $mysqlObj = new MysqlConnector();
            $query = "SELECT * FROM EstadoValidacionVacante WHERE idEstadoValidacionVacante=".$idEstado;
            $result = $mysqlObj->consultaRetorno($query);
            if($result!=false){
                $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                throw new Exception("Error al obtener el estado");
            }
        } catch (Exception $e) {
            throw new Exception("Error al obtener el estado: ".$e->getMessage());
        }
        return $result;
    }

}