<?php
interface IPostulacionGateway{
    public function InsertarPostulacion(IPostulacion $postulacion):int;
}