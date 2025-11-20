<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IPostulanteCertificaciones.php";

class PostulanteCertificacionesGateway implements IPostulanteCertificaciones{

     public function listarPostulanteCertificaciones():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM Certificaciones";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }
}