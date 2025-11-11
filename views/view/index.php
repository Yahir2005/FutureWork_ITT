<?php 
    include_once("../router/Router.php");
    include_once __DIR__ . '/../usecase/Usuario/SessionManager.php';
    session_start();
    //
?>
<!DOCTYPE html>
<html>
<head>
	<title> BookService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="?cargar=cloaseSession">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inventario
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=ProductoListarView">Ver productos</a></li>
          
            <li><a class="dropdown-item" href="?cargar=ProductoAddView">Registrar producto</a></li>
            
          </ul> 
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Marca
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=MarcaAddView">Registrar Marca</a></li>
          
            <li><a class="dropdown-item" href="?cargar=MarcaListView">Listar Marca</a></li>
          </ul> 
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Unidad
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=UnidadAddView">Registrar Unidad</a></li>
          <li><a class="dropdown-item" href="?cargar=UnidadListView">Listar Unidad</a></li>
          </ul> 
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Proveedor
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=ProveedorAddView">Registrar Proveedor</a></li>
          <li><a class="dropdown-item" href="?cargar=ProveedorListarView">Ver Proveedor</a></li>
          </ul> 
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=ClienteAddView">Registrar cliente</a></li>
          <li><a class="dropdown-item" href="?cargar=ClienteListarView">Ver Clientes</a></li>
          </ul> 
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Imagenes
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="?cargar=ImagenAddView">Registrar Imagen portada</a></li>
          <li><a class="dropdown-item" href="?cargar=ImagenProductoAddView">Registrar Imagenes del producto</a></li>

          </ul> 
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="?cargar=EXIT">Salir</a>
        </li>

        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">BookService</a>
        </li>

      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<section>
            <?php

                $enrutador = new Router();
                if(isset($_GET['cargar']))
                if($enrutador->validarGET($_GET['cargar'])){
                    $enrutador->cargarVista($_GET['cargar']);
                }
            ?>
</section>
</body>
</html>