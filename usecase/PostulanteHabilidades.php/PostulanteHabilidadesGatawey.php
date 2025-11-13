<?php
require_once __DIR__ ."/IVacante.php";
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
class PostulanteHabilidadesGatawey implements IPostulanteHabilidades{
 public function InsertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):int{
     $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO PostulanteHabilidades (
           Postulante_idPostulante,
           Habilidades_idHabilidad
        ) VALUES (
            '{$PostulanteHabilidades->get('Postulante_idPostulante')}',
            '{$PostulanteHabilidades->get('Habilidades_idHabilidad')}',
        )";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function ActualizarPostulanteHabilidades($id, $postulanteHabilidades):int {
         $mysqlConnector = new MysqlConnector();
        $sql = "UPDATE Postulante Habilidades SET 
            Postulante_idPostulante = '{$PostulanteHabilidades->get('Postulante_idPostulante')}',
            Habilidades_idHabilidad = '{$PostulanteHabilidades->get('Habilidades_idHabilidad')}',
          
        WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function EliminarPostulanteHabilidades($id): int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM Postulante Habilidades WHERE idPostulanteHabilidades = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function ListarPostulanteHabilidades():array{
     $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Postulante Habilidades";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}