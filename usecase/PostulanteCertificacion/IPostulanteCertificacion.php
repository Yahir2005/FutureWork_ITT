<?php
interface IPostulanteCertificacion{

    public function ListarPostulanteCertificacion():array;

    public function InsertarPostulanteCertificacion (PostulanteCertificacion $postulanteCertificacion):int;

    public function ActualizarPostulanteCertificacion ($id, $postulanteCertificacion):int;
    
    public function EliminarPostulanteCertificacion($id):int;
<<<<<<< HEAD
    
}
=======
     
}
>>>>>>> 30d21ec9127b6b4ede7665138f900b00d23f53e9
