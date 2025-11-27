<?php
require_once __DIR__ ."/IPostulanteHabilidades.php";
require_once __DIR__ ."/../DataAccess/MysqlConnector.php";
class PostulanteHabilidadesGatawey implements IPostulanteHabilidades{
 public function insertarPostulanteHabilidades(PostulanteHabilidades $postulanteHabilidades):int{
     $mysqlConnector = new MysqlConnector();
        $sql = "INSERT INTO Postulante_Habilidades (
           Postulante_idPostulante,
           Habilidades_idHabilidad
        )
        VALUES (
            '{$postulanteHabilidades->get('Postulante_idPostulante')}',
            '{$postulanteHabilidades->get('Habilidades_idHabilidad')}')";
        $result = $mysqlConnector->consultaSimple($sql);
        return $result;
    }

}
