<?php
require_once __DIR__ ."/IImagenEmpresaPerfil.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenEmpresaPerfilGateway implements IImagenEmpresaPerfil {
    public function subirImagenPerfilEmpresa(EmpresaImagenPerfil $imagenData):int{
            $query = "INSERT INTO EmpresaImagenPerfil(Nombre, rutaImagenPerfilEmpresa) VALUES 
            ('{$imagenData->get('Nombre')}',
           '{$imagenData->get('rutaImagenPerfilEmpresa')}')";
            $mysqlConnector = new MysqlConnector();
            $mysqlConnector->consultaSimple($query);
            return (int)$mysqlConnector->getConnection()->insert_id;
    }
}
