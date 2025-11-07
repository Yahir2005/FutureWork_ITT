<?php
require_once __DIR__ ."/IImagenesEmpresa.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenesEmpresaGateway implements IImagenesEmpresa {

    public function subirImagenEmpresa(ImagenesEmpresa $imagenData): bool {
        $mysqlConnector = new MysqlConnector();
        $result = false;
        $sql = "INSERT INTO ImagenesEmpresa (Empresas_idEmpresas,urlImagen) VALUES 
        ('{$imagenData->get('Empresas_idEmpresas')}','{$imagenData->get('urlImagen')}')";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ListarImagenesEmpresa(): array {
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM ImagenesEmpresa";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function eliminarImagenEmpresa($idEmpresa): int {
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM ImagenesEmpresa WHERE idImagen={$idEmpresa}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
}