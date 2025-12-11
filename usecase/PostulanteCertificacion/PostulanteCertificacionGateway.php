<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ . "/IPostulanteCertificacion.php";

class PostulanteCertificacionGateway implements IPostulanteCertificacion{
   
    public function listarPostulanteCertificacion():array{
        $objSQL = new MysqlConnector();
        $sql = "SELECT * FROM Postulante_Certificacion";
        $result = $objSQL ->consultaRetorno($sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
     }

     public function InsertarPostulanteCertificacion(PostulanteCertificacion $postulanteCertificacion):int {
        $objSQL = new MysqlConnector();
        $sql = "INSERT INTO Postulante_Certificacion (
        Postulante_idPostulante,
        Certificaciones_idCertificacion
        ) VALUES (
        '{$postulanteCertificacion->get('Postulante_idPostulante')}',
        '{$postulanteCertificacion->get('Certificaciones_idCertificacion')}'
        )";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }

    public function ActualizarPostulanteCertificacion($id, $postulanteCertificacion):int {
        $objSQL = new MysqlConnector();
        $sql = "UPDATE Postulante_Certificacion SET 
            Postulante_idPostulante = '{$postulanteCertificacion->get('Postulante_idPostulante')}',
            Certificaciones_idCertificacion = '{$postulanteCertificacion->get('Certificaciones_idCertificacion')}'
        WHERE Postulante_idPostulante = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }
    public function EliminarPostulanteCertificacion($id): int{
        $objSQL = new MysqlConnector();
        $sql = "DELETE FROM Postulante_Certificacion WHERE Postulante_idPostulante = {$id}";
        $result = $objSQL->consultaSimple($sql);
        return $result;
    }
     
} 
