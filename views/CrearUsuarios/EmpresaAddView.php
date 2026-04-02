<?php
// Line 60
if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $tmpName = $_FILES['imagen']['tmp_name'];
    $name = time() . '_' . $_FILES['imagen']['name'];
    $destination = 'Files/PerfilEmpresa/' . $name;

    if (move_uploaded_file($tmpName, $destination)) {
        $empresaImagenPerfil = $destination;
        // Insert the image and retrieve the insert ID
        $insertId = $this->controllerEmpresaImagenPerfil->insertImage($empresaId, $empresaImagenPerfil);
    } else {
        // Handle error in moving the file
        $this->warning_imagen = 'Error moving the uploaded file.';
    }
} else {
    // Handle upload error
    $this->warning_imagen = 'Error occurred: ' . $_FILES['imagen']['error'];
}
