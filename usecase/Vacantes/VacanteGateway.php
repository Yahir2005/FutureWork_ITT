<?php
require_once __DIR__ ."/IVacante.php";
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";

class VacanteGateway implements IVacante{
    public function InsertarVacante(Vacantes $vacantes):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO Vacantes (
            Empresa_idEmpresa,
            EstadoValidacionVacante_idEstadoValidacionVacante, 
            TipoContrato_idTipoContrato, 
            TipoModalidad_idTipoModalidad,
            titulo,
            descripcion,
            requisitos,
            ubicacion,
            salario,
            fechaLimite
        ) VALUES (
            '{$vacantes->get('Empresa_idEmpresa')}',
            '{$vacantes->get('EstadoValidacionVacante_idEstadoValidacionVacante')}',
            '{$vacantes->get('TipoContrato_idTipoContrato')}',
            '{$vacantes->get('TipoModalidad_idTipoModalidad')}',
            '{$vacantes->get('titulo')}',
            '{$vacantes->get('descripcion')}',
            '{$vacantes->get('requisitos')}',
            '{$vacantes->get('ubicacion')}',
            '{$vacantes->get('salario')}',
            '{$vacantes->get('fechaLimite')}'
        )";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ActualizarVacante($id, $vacantes):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "UPDATE Vacantes SET 
            EstadoValidacionVacante_idEstadoValidacionVacante = '{$vacantes->get('EstadoValidacionVacante_idEstadoValidacionVacante')}',
            TipoContrato_idTipoContrato = '{$vacantes->get('TipoContrato_idTipoContrato')}',
            TipoModalidad_idTipoModalidad = '{$vacantes->get('TipoModalidad_idTipoModalidad')}',
            titulo = '{$vacantes->get('titulo')}',
            descripcion = '{$vacantes->get('descripcion')}',
            requisitos = '{$vacantes->get('requisitos')}',
            ubicacion = '{$vacantes->get('ubicacion')}',
            salario = '{$vacantes->get('salario')}',
            fechaLimite = '{$vacantes->get('fechaLimite')}'
        WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function EliminarVacante($id):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM Vacantes WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

    public function ListarVacantes():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Vacantes";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarVacantesPorNombre($nombre):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Vacantes WHERE titulo LIKE '%{$nombre}%'";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarVacantesPorEmpresa($idEmpresa):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT
            EVV.estadoValidacionVacante,
            TC.estadoContrato,
            TM.tipoModalidad,
            V.idVacante,
            V.titulo,
            V.descripcion,
            V.requisitos,
            V.ubicacion,
            V.salario,
            V.fechaPublicacion,
            V.fechaLimite
        FROM
            Vacantes AS V
        JOIN
            EstadoValidacionVacante AS EVV ON V.EstadoValidacionVacante_idEstadoValidacionVacante = EVV.idEstadoValidacionVacante
        JOIN
            TipoContrato AS TC ON V.TipoContrato_idTipoContrato = TC.idTipoContrato
        JOIN
            TipoModalidad AS TM ON V.TipoModalidad_idTipoModalidad = TM.idTipoModalidad WHERE Empresa_idEmpresa = {$idEmpresa}";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ListarVacantesPorEstadoEmpresaContrato($idEstado):array{
        $mysqlConnector = new MysqlConnector();
        $idEmpresa = (int)$idEstado; // seguridad básica
        $sql = "
            SELECT 
                v.*,
                tc.estadoContrato AS tipoContrato,
                tm.tipoModalidad AS modalidad,
                COUNT(p.idPostulacion) AS candidatos
            FROM Vacantes v
            LEFT JOIN Postulaciones p ON p.Vacante_idVacante = v.idVacante
            LEFT JOIN TipoContrato tc ON tc.idTipoContrato = v.TipoContrato_idTipoContrato
            LEFT JOIN TipoModalidad tm ON tm.idTipoModalidad = v.TipoModalidad_idTipoModalidad
            WHERE v.Empresa_idEmpresa = {$idEstado}
            GROUP BY v.idVacante
            ORDER BY v.fechaPublicacion DESC
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if($result === false) return [];
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ContarCandidatosPorVacante($idVacante):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Postulaciones WHERE WHERE Vacante_idVacante = {$idVacante}";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function contarVacantes():int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

        public function contarVacantesAbiertas():int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante= 1";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function contarVacantesCerradas():int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante= 2";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

        public function contarVacantesPausadas():int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante= 3";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }


    public function ListarVacantesTotalesCard():array{
        $mysqlConnector = new MysqlConnector();
        $sql = "
        SELECT
            EVV.estadoValidacionVacante,
            TC.estadoContrato,
            TM.tipoModalidad,
            V.titulo,
            V.descripcion,
            V.requisitos,
            V.ubicacion,
            V.salario,
            V.fechaPublicacion,
            V.fechaLimite
        FROM
            Vacantes AS V
        JOIN
            EstadoValidacionVacante AS EVV ON V.EstadoValidacionVacante_idEstadoValidacionVacante = EVV.idEstadoValidacionVacante
        JOIN
            TipoContrato AS TC ON V.TipoContrato_idTipoContrato = TC.idTipoContrato
        JOIN
            TipoModalidad AS TM ON V.TipoModalidad_idTipoModalidad = TM.idTipoModalidad
        ";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 

        public function contarVacantesAbiertasPorEmpresa($idEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante = 1 AND Empresa_idEmpresa = {$idEmpresa}";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function contarVacantesCerradasPorEmpresa($idEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante = 2 AND Empresa_idEmpresa = {$idEmpresa}";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function contarVacantesPausadasPorEmpresa($idEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes WHERE EstadoValidacionVacante_idEstadoValidacionVacante = 3 AND Empresa_idEmpresa = {$idEmpresa}";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function contarVacantesPorEmpresa($idEmpresa):int{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT COUNT(*) AS total FROM Vacantes  WHERE Empresa_idEmpresa = {$idEmpresa} ";
        $result = $mysqlConnector->consultaRetorno($sql);
        if ($result === false) return 0;
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

        public function obtenerVacanteporId($id): array{
        $result= [];
        try{
            $mysqlConnector = new MysqlConnector();
            $sql = "SELECT * FROM Vacantes WHERE idVacante = {$id} ";
            $result = $mysqlConnector->consultaRetorno($sql);
            if($result!=false){
                $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                throw new Exception("Error al obtener la vacante");
            }
        }catch(Exception $e){
            throw new Exception("Error al obtener la vacante: ".$e->getMessage());
        }
        
        return $result;
    }


}