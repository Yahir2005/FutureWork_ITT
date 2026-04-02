<?php
require_once __DIR__ ."/IImagenEmpresaPerfil.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/../../../Dto/ImagenEmpresaPerfil.php";

class ImagenEmpresaPerfilGateway implements IImagenEmpresaPerfil {
    public function subirImagenPerfilEmpresa(EmpresaImagenPerfil $imagenData):bool{
            $result = false;
            $query = "INSERT INTO EmpresaImagenPerfil(Nombre, rutaImagenPerfilEmpresa) VALUES 
            ('{$imagenData->get('Nombre')}',
           '{$imagenData->get('rutaImagenPerfilEmpresa')}')";

            $mysqlConnector = new MysqlConnector();
            $result = $mysqlConnector->consultaSimple($query);
            return $result;
    }
}
