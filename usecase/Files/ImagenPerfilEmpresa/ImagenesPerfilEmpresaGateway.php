<?php
require_once __DIR__ ."/IImagenesPerfilEmpresa.php";
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";

class ImagenesPerfilEmpresaGateway implements IImagenesPerfilEmpresa{
    public function InsertarImagenPerfilEmpresa(ImagenPerfilEmpresa $imagenPerfilEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql ="INSERT INTO ImagenPerfilEmpresa (Empresas_idEmpresas,EmpresaPerfilImagen_idEmpresaPerfilImagen) VALUES 
        ('{$imagenPerfilEmpresa->get('Empresas_idEmpresas')}',
        '{$imagenPerfilEmpresa->get('EmpresaPerfilImagen_idEmpresaPerfilImagen')}')";
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
    public function perfilEmpresa($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT IP.idImagenEmpresa,
        IP.Empresas_idEmpresas,
        IP.EmpresaPerfilImagen_idEmpresaPerfilImagen,
        EIP.idEmpresaPerfilImagen,
        EIP.Nombre,
        EIP.rutaImagenPerfilEmpresa,
        E.idEmpresas,
        E.EstadoValidacionEmpresa_idEstadoValidacionEmpresa,
        E.Usuarios_idUsuarios,
        E.nombreEmpresa,
        E.sector,
        E.representante,
        E.descripcion,
        E.sitioWeb
        FROM ImagenPerfilEmpresa IP 
        JOIN EmpresaImagenPerfil EIP ON IP.EmpresaPerfilImagen_idEmpresaPerfilImagen = EIP.idEmpresaPerfilImagen
        JOIN Empresas E ON IP.Empresas_idEmpresas = E.idEmpresas 
        WHERE E.idEmpresas = {$id}";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}