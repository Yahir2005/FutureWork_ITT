<?PHP

interface IImagenesEmpresa {
    public function subirImagenEmpresa(ImagenesEmpresa $imagenData):bool;
    public function ListarImagenesEmpresa():array;
    public function eliminarImagenEmpresa($idEmpresa):int;
}