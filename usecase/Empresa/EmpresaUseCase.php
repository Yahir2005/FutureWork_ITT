<?php
require_once __DIR__ ."/../../Dto/RespuestaGenerica.php";
class EmpresaUseCase{
    private $gatewayDb;

    public function __construct(IEmpresa $gatewayDb){
        $this->gatewayDb = $gatewayDb;
    }

} 