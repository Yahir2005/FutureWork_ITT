<?PHP
require_once __DIR__ ."/../../../Dto/ImagenesEmpresa.php";

interface IImagenesEmpresa {
    public function subirImagenEmpresa(ImagenesEmpresa $imagenData):bool;
    public function ListarImagenesEmpresa():array;
    public function eliminarImagenEmpresa($idEmpresa):int;
}