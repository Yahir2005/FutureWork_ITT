<?php
require_once __DIR__ ."/IImagenesPerfilEmpresa.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenesPerfilEmpresaGateway implements IImagenesPerfilEmpresa{
    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql ="INSERT INTO ImagenPerfilEmpresa (Empresas_idEmpresas,urlImagenPerfilEmpresa) VALUES 
        ('{$imagenPerfilEmpresa->get('Empresas_idEmpresas')}',
        '{$imagenPerfilEmpresa->get('urlImagenPerfilEmpresa')}')";
        $result= $mysqlConnector->consultaSimple( $sql );
        return $result;
    }

    public function eliminarImagen($id):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM ImagenPerfilEmpresa WHERE idImagenEmpresa = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function obtenerImagenes($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM ImagenPerfilEmpresa WHERE idImagenEmpresa = {$id}";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}