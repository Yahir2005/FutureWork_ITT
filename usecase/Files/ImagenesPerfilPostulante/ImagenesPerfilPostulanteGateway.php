<?php
require_once __DIR__ . "/IImagenesPerfilPostulante.php";
require_once __DIR__ . "/../../DataAccess/MysqlConnector.php";

class ImagenesPerfilPostulanteGateway implements IImagenesPerfilPostulante{
    public function InsertarImagenPerfilPostulante(ImagenesPerfilPostulante $imagenesPerfilPostulante):int{
        $mysqlConnector = new MysqlConnector();
        $sqlImagen = "INSERT INTO PostulanteImagenPerfil (nombreImagen, rutaImagenPerfilPostulante) 
        VALUES 
        ('{$imagenesPerfilPostulante->get('nombreImagen')}', 
        '{$imagenesPerfilPostulante->get('rutaImagenPerfilPostulante')}')";
        $mysqlConnector->consultaSimple($sqlImagen);
        $idImagenPerfilPostulante = $mysqlConnector->getConnection()->insert_id;

        $sqlRelacion = "INSERT INTO ImagenesPerfilPostulante (Postulante_idPostulante, PostulanteImagenPerfil_idImagenPerfilPostulante) 
        VALUES 
        ('{$imagenesPerfilPostulante->get('Postulante_idPostulante')}', 
        '{$idImagenPerfilPostulante}')";
        $result = $mysqlConnector->consultaSimple($sqlRelacion);
        return $result;
    }

    public function EliminarImagenPerfilPostulante($id):int{
        $mysqlConnector = new MysqlConnector();
        $sqlSelect = "SELECT PostulanteImagenPerfil_idImagenPerfilPostulante FROM ImagenesPerfilPostulante WHERE idImagenPostulante = '{$id}'";
        $resultadoSelect = $mysqlConnector->consultaRetorno($sqlSelect);
        $registro = mysqli_fetch_assoc($resultadoSelect);

        $sql = "DELETE FROM ImagenesPerfilPostulante WHERE idImagenPostulante = '{$id}'";
        $result = $mysqlConnector->consultaSimple($sql);

        if ($registro && isset($registro['PostulanteImagenPerfil_idImagenPerfilPostulante'])) {
            $sqlImagen = "DELETE FROM PostulanteImagenPerfil WHERE idImagenPerfilPostulante = '{$registro['PostulanteImagenPerfil_idImagenPerfilPostulante']}'";
            $mysqlConnector->consultaSimple($sqlImagen);
        }
        return $result;
    }

    public function MostrarImagenPerfilPostulante($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT IPP.idImagenPostulante,
        IPP.Postulante_idPostulante,
        IPP.PostulanteImagenPerfil_idImagenPerfilPostulante,
        PIP.nombreImagen,
        PIP.rutaImagenPerfilPostulante
        FROM ImagenesPerfilPostulante IPP
        JOIN PostulanteImagenPerfil PIP ON IPP.PostulanteImagenPerfil_idImagenPerfilPostulante = PIP.idImagenPerfilPostulante
        WHERE IPP.idImagenPostulante = '{$id}'";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function perfilPostulante($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT IPP.idImagenPostulante,
        PIP.idImagenPerfilPostulante,
        PIP.nombreImagen,
        PIP.rutaImagenPerfilPostulante,
        P.idPostulante,
        P.numeroControl,
        P.cvPath,
        P.telefono,
        P.ubicacion
        FROM ImagenesPerfilPostulante IPP
        JOIN PostulanteImagenPerfil PIP ON IPP.PostulanteImagenPerfil_idImagenPerfilPostulante = PIP.idImagenPerfilPostulante
        JOIN Postulante P ON IPP.Postulante_idPostulante = P.idPostulante
        WHERE P.idPostulante = {$id}";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
