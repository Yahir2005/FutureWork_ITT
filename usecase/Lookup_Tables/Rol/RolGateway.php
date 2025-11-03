<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IRolGateway.php";

class RolGateway implements IRolGateway{
    public function ListarRoles(): array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Rol";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function ListarRolPorId($idRol): array{
        $result = [];
        try {
            $mysqlObj = new MysqlConnector();
            $query = "SELECT * FROM Rol WHERE idRol =".$idRol;
            $result = $mysqlObj->consultaRetorno($query);
            if($result!=false){
                $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                throw new Exception("Error al obtener el rol");
            }
        } catch (Exception $e) {
            throw new Exception("Error al obtener el rol: ".$e->getMessage());
        }
        return $result;
    }
}