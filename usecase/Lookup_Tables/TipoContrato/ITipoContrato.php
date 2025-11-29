<?php
interface ITipoContrato{

  public function listarTipoContrato():array;

  public function listarTipoContratoPorId($id): array;

}