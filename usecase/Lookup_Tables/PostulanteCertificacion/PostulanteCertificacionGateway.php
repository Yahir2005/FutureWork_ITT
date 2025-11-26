<?php
require_once __DIR__ ."/../../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IPostulanteCertificacion.php";

class PostulanteCertificacionGateway implements IPostulanteCertificacion{
   
    public function listarPostulanteCertificacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM Postulante_Certificacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }

     public function insertarPostulanteCertificacion(PostulanteCertificacion $postulanteCertificacion):int {
        $objSQL = new MysqlConnector();
        $sql = "INSERT INTO Postulante_Certificacion (
        postulante_idPostulante,
        certificaciones_idCertificacion
        ) VALUES (
        '{$postulanteCertificacion->get('postulante_idPostulante')}',
        '{$postulanteCertificacion->get('certificaciones_idCertificacion')}'
        )";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }

    public function ActualizarPostulanteCertificacion($id, $postulanteCertificacion):int {
        $objSQL = new MysqlConnector();
        $sql = "UPDATE Postulante_Certificacion SET 
            postulante_idPostulante = '{$postulanteCertificacion->get('postulante_idPostulante')}',
            certificaciones_idCertificacion = '{$postulanteCertificacion->get('certificaciones_idCertificacion')}'
        WHERE idPostulante_Certificacion = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }
    public function EliminarPostulanteCertificacion($id): int{
        $objSQL = new MysqlConnector();
        $sql = "DELETE FROM Postulante_Certificacion WHERE idPostulante_Certificacion = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }
     
} 