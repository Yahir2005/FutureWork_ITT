<?php
interface IPostulaciones{
    public function InsertarPostulacion(Postulaciones $postulacion):int;
    public function ListarPostulacionesPorVacante($idVacante):array;
    public function ListarVacantesPostuladasPorPostulante($idPostulante):array;
    
    public function contartotalPostulacionesPorVacante($idVacante):int;
    
    public function contartotalRevisionPorVacante($idVacante):int;
    
    public function contartotalAceptadasPorVacante($idVacante):int;
    
    public function contartotalEntrevistaProgramadaPorVacante($idVacante):int;
    

}