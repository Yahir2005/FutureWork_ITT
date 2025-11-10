<?php
class Vacantes{
    private $idVacante;
    private $Empresa_idEmpresa;
    private $EstadoValidacionVacante_idEstadoValidacionVacante;
    private $TipoContrato_idTipoContrato;
    private $TipoModalidad_idTipoModalidad;
    private $titulo;
    private $descripcion;
    private $requisitos;
    private $ubicacion;
    private $salario;
    private $fechaPublicacion;
    private $fechaLimite;

    public function get($property){
        return $this->$property;
    }
    public function set($property,$value)  {
        $this->$property = $value;
    }
}
