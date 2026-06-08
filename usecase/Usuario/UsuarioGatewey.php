<?php
require_once __DIR__ .'/../DataAccess/MysqlConnector.php';
require_once __DIR__ .'/IUsuarioGateway.php';

class UsuarioGatewey implements IUsuarioGateway{
    public function InsertarUsuario(Usuario $usuario): int{
        $mysqlObj = new MysqlConnector();
        $conn = $mysqlObj->getConnection();

        $passwordHash = password_hash($usuario->get('Password'), PASSWORD_DEFAULT);
        
        $sqlQuery = "INSERT INTO Usuarios(Rol_idRol, nombreCompleto, email, Password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlQuery);
        
        if(!$stmt){
             throw new Exception("Error al preparar la consulta de inserción.");
        }

        $rol = $usuario->get('Rol_idRol');
        $nombre = $usuario->get('nombreCompleto');
        $email = $usuario->get('email');

        $stmt->bind_param("isss", $rol, $nombre, $email, $passwordHash);

        try {
            $stmt->execute();
            return $stmt->insert_id;
        } catch (Exception $e) {
            throw new Exception("Error al insertar usuario");
        }
    }

    public function ListarUsuarios(): array
    {
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Usuarios";
        $result = $mysqlConnector->consultaRetorno($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ActualizarUsuarios($id, $usuario): bool{
        $sqlQuery = "UPDATE Usuarios SET 
        Rol_idRol='{$usuario->get('Rol_idRol')}',
        nombreCompleto='{$usuario->get('nombreCompleto')}',
        email='{$usuario->get('email')}',
        Password='{$usuario->get('Password')}'
        WHERE idUsuarios={$id}";
        $mysqlObj = new MysqlConnector();
        try {
            $mysqlObj->consultaSimple($sqlQuery);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar usuario");
        }
    }
    public function DeleteUsuario($id):bool{
        $sqlQuery = "DELETE FROM Usuarios WHERE idUsuarios={$id}";
        $mysqlObj = new MysqlConnector();
        try {
            $mysqlObj->consultaSimple($sqlQuery);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error al eliminar usuario");
        }
    }

    public function iniciarSesion(string $usuario, string $contrasena): array {
        $mysqlObj = new MysqlConnector();
        $conn = $mysqlObj->getConnection();

        $sql = "SELECT idUsuarios, Rol_idRol, Password FROM Usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        
        if(!$stmt){
            throw new Exception("Error al preparar la consulta de inicio de sesión.");
        }

        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($contrasena, $row['Password'])) {

            unset($row['Password']); 
            return $row;
        } else {
            throw new Exception("Usuario o contraseña incorrectos");
        }
    }

    public function obtenerUsuarioPorId($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Usuarios WHERE idUsuarios ={$id} ";
        $result = $mysqlConnector->consultaRetorno( $sql );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function obtenerIdRolUsuarios($id):array{
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT * FROM Usuarios WHERE Rol_idRol = {$id} ";
        $result = $mysqlConnector->consultaRetorno( $sql );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function iniciarSesionG(string $usuario, string $contrasena): array{
        $sql = "SELECT 
                E.idEmpresas,
                P.idPostulante 
            FROM Usuarios U
            LEFT JOIN Empresas E ON E.Usuarios_idUsuarios = U.idUsuarios
            LEFT JOIN Postulante P ON P.Usuarios_idUsuarios = U.idUsuarios
            WHERE email='$usuario'
            AND Password='$contrasena'";
        $mysqlObj = new MysqlConnector();
        $result = $mysqlObj->consultaRetorno($sql);
               $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row;
        } else {

            throw new Exception("Usuario o contraseña incorrectos");
        }
    }


    public function getIdByRol($idRol): array {
        $mysqlConnector = new MysqlConnector();
        $sql = "SELECT idUsuarios FROM Usuarios WHERE Rol_idRol = {$idRol} ";
        $result = $mysqlConnector->consultaRetorno( $sql );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function obtenerEntidadPorUsuario(int $idUsuario): array {
    $mysqlObj = new MysqlConnector();
    $sql = "SELECT 
                E.idEmpresas AS empresaId,
                P.idPostulante AS postulanteId
            FROM Usuarios U
            LEFT JOIN Empresas E ON E.Usuarios_idUsuarios = U.idUsuarios
            LEFT JOIN Postulante P ON P.Usuarios_idUsuarios = U.idUsuarios
            WHERE U.idUsuarios = $idUsuario";
        
        $result = $mysqlObj->consultaRetorno($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row; // Devuelve empresaId y/o postulanteId
        } else {
            return ["empresaId" => null, "postulanteId" => null];
        }
    }

}
