<?php
require_once __DIR__ ."/EstadoPostulacionGateway.php";
require_once __DIR__ ."/EstadoPostulacionUseCase.php";
require_once __DIR__ . "/../../../Dto/EstadoPostulacion.php";

class EstadoPostulacionController {
    private $usecase;

    public function __construct($dbConnection) {
        $gateway = new EstadoPostulacionGateway($dbConnection);
        $this->usecase = new EstadoPostulacionUseCase($gateway);
    }

    public function listar() {
        $result = $this->usecase->listarEstadoPostulacion();
        echo json_encode($result);
    }

    public function listarPorId($id) {
        $result = $this->usecase->listarEstadoPostulacionId(intval($id));
        echo json_encode($result);
    }

    public function insertar($body) {
        $result = $this->usecase->insertarEstadoPostulacion($body);
        echo json_encode($result);
    }

    public function actualizar($id, $body) {
        $result = $this->usecase->actualizarEstadoPostulacion(intval($id), $body);
        echo json_encode($result);
    }

    public function eliminar($id) {
        $result = $this->usecase->eliminarEstadoPostulacion(intval($id));
        echo json_encode($result);
    }
}

/**class EstadoPostulacionController{

     public function listarEstadoPostulacion(): RespuestaGenerica{
        $gateway = new EstadoPostulacionGateway();
        $useCase = new EstadoPostulacionUseCase($gateway);
        return $useCase-> listarEstadoPostulacion();
     }
}*/

/*
$controller = new EstadoPostulacionController();
$response = $controller->listarEstadoPostulacion();
echo $response-> message;
*/