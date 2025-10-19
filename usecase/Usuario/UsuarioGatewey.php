<?php
require_once __DIR__ .'/../DataAccess/MysqlConnector.php';
require_once __DIR__ .'/IUsuarioGateway.php';

class UsuarioGatewey implements IUsuarioGateway{
    public function InsertarUsuario(Usuario $usuario): int{
        $idInsertado=0;
        $sqlQuery = "INSERT INTO Usuarios(idRol,nombreCompleto,email,Password) VALUES('{$usuario->get('idRol')}',
        '{$usuario->get('nombreCompleto')}',
        '{$usuario->get('email')}',
        '{$usuario->get('Password')}')";
        $mysqlObj = new MysqlConnector();
        try {
            $mysqlObj->consultaSimple($sqlQuery);
            $idInsertado = $mysqlObj->getConnection()->insert_id;
        } catch (Exception $e) {
            throw new Exception("Error al insertar usuario");
        }
        return $idInsertado;
    }
}