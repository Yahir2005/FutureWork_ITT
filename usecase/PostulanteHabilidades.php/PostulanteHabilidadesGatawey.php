<?php
require_once __DIR__ ."/IPostulanteHabilidades.php";
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
class PostulanteHabilidadesGatawey implements IPostulanteHabilidades{
 public function InsertarPostulanteHabilidades(PostulanteHabilidades $PostulanteHabilidades):int{
     $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO Postulante_Habilidades (
           Postulante_idPostulante,
           Habilidades_idHabilidad
        ) VALUES (
            '{$PostulanteHabilidades->get('Postulante_idPostulante')}',
            '{$PostulanteHabilidades->get('Habilidades_idHabilidad')}',
        )";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function ActualizarPostulanteHabilidades($id, $PostulanteHabilidades):int {
         $mysqlConnector = new MysqlConnector();
        $sql = "UPDATE Postulante_Habilidades SET 
            Postulante_idPostulante = '{$PostulanteHabilidades->get('Postulante_idPostulante')}',
            Habilidades_idHabilidad = '{$PostulanteHabilidades->get('Habilidades_idHabilidad')}',
          
        WHERE idVacante = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function EliminarPostulanteHabilidades($id): int{
        $mysqlConnector = new MysqlConnector();
        $sql = "DELETE FROM Postulante_Habilidades WHERE idPostulante_Habilidades = {$id}";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }
  public function ListarPostulanteHabilidades():array{
     $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Postulante_Habilidades";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
