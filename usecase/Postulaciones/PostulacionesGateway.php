<?php
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
require_once __DIR__ ."/IPostulaciones.php";
require_once __DIR__ ."/../../Dto/Postulaciones.php";
class PostulacionesGateway implements IPostulaciones{

    public function InsertarPostulacion(Postulaciones $postulacion):int{
        $mysqlConnector = new MysqlConnector();
        $query = "INSERT INTO Postulaciones (Postulante_idPostulante,
        Vacante_idVacante,
        EstadoPostulacion_idEstadoPostulacion,
        fechaPostulacion)
        VALUES ('{$postulacion->get('Postulante_idPostulante')}',
        '{$postulacion->get('Vacante_idVacante')}',
        '{$postulacion->get('EstadoPostulacion_idEstadoPostulacion')}',
        '{$postulacion->get('fechaPostulacion')}')";
        $result = $mysqlConnector->consultaSimple($query);
        return $result;
    }


    public function ListarPostulacionesPorVacante($idVacante):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "
            SELECT 
              p.idPostulacion,
              u.nombreCompleto,
              u.email,
              po.numeroControl,
              po.telefono,
              po.ubicacion,
              po.cvPath,
              c.nombreCarrera,
              ep.estadoPostulacion,
              p.fechaPostulacion
            FROM Postulaciones p
            INNER JOIN EstadoPostulacion ep ON ep.idEstadoPostulacion = p.EstadoPostulacion_idEstadoPostulacion
            INNER JOIN Postulante po ON p.Postulante_idPostulante = po.idPostulante
            INNER JOIN Usuarios u ON po.Usuarios_idUsuarios = u.idUsuarios
            INNER JOIN Carrera c ON po.Carrera_idCarrera = c.idCarrera
            WHERE p.Vacante_idVacante = {$idVacante}
            ORDER BY p.fechaPostulacion DESC";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

        public function contartotalPostulacionesPorVacante($idVacante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "
        SELECT COUNT(*) AS total FROM Postulaciones WHERE Vacante_idVacante = {$idVacante}
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

            public function contartotalRevisionPorVacante($idVacante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "
        SELECT COUNT(*) AS total FROM Postulaciones WHERE Vacante_idVacante = {$idVacante} AND EstadoPostulacion_idEstadoPostulacion = 1
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }


        public function contartotalAceptadasPorVacante($idVacante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "
        SELECT COUNT(*) AS total FROM Postulaciones WHERE Vacante_idVacante = {$idVacante} AND EstadoPostulacion_idEstadoPostulacion = 2
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

        public function contartotalEntrevistaProgramadaPorVacante($idVacante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "
        SELECT COUNT(*) AS total FROM Postulaciones WHERE Vacante_idVacante = {$idVacante} AND EstadoPostulacion_idEstadoPostulacion = 4
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }
    


}