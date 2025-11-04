<?php
require_once __DIR__ ."/RolGateway.php";
require_once __DIR__ ."/RolUseCase.php";


class RolController{
    public function ListarRoles(): RespuestaGenerica {
        $gatewayDB = new RolGateway();
        $UseCase = new RolUseCase($gatewayDB);
        return $UseCase->ListarRoles();
    }

    public function ListarRolPorId($idRol): RespuestaGenerica {
        $gatewayDB = new RolGateway();
        $UseCase = new RolUseCase($gatewayDB);
        return $UseCase->ListarRolPorId($idRol);
    }

}
/*
$controller = new RolController();
$response = $controller->ListarRoles();
echo $response->message;
*/
/*
$controller = new RolController();
$response = $controller->ListarRolPorId(1);
echo $response->message;
*/



