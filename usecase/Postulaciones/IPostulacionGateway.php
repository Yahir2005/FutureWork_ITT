<?php
interface IPostulacionGateway{
    public function InsertarPostulacion(Postulaciones $postulacion):int;
}