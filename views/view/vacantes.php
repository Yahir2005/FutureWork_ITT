<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Vacantes Disponibles</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      min-height: 100%;
    }

    html {
      height: 100%;
    }

    /* Contenido Principal */
    .main-content {
      max-width: 1400px;
      margin: 0 auto;
      padding: 30px;
      display: grid;
      grid-template-columns: 300px 1fr;
      gap: 30px;
    }

    /* Sidebar de Filtros */
    .filters-sidebar {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      height: fit-content;
      position: sticky;
      top: 90px;
    }

    .filters-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid #f0f0f0;
    }

    .filters-header h2 {
      color: #1e3c72;
      font-size: 20px;
    }

    .filter-group {
      margin-bottom: 25px;
    }

    .filter-group label {
      display: block;
      color: #333;
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .filter-group select,
    .filter-group input {
      width: 100%;
      padding: 12px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .filter-group select:focus,
    .filter-group input:focus {
      outline: none;
      border-color: #2a5298;
      background: white;
    }

    .btn-filter {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-filter:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .btn-clear {
      width: 100%;
      padding: 12px;
      background: white;
      color: #666;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-clear:hover {
      background: #f8f9fa;
      border-color: #ccc;
    }

    /* Área de Vacantes */
    .vacantes-area {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .vacantes-header {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .vacantes-header h1 {
      color: #1e3c72;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .vacantes-count {
      color: #666;
      font-size: 15px;
    }

    /* Tarjetas de Vacantes */
    .vacante-card {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      border-left: 4px solid #2a5298;
    }

    .vacante-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .vacante-header {
      display: flex;
      justify-content: space-between;
      align-items: start;
      margin-bottom: 15px;
    }

    .vacante-title-area {
      flex: 1;
    }

    .vacante-title {
      color: #1e3c72;
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .vacante-empresa {
      color: #666;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .vacante-logo {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    .vacante-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 15px;
    }

    .tag {
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .tag-modalidad {
      background: #e3f2fd;
      color: #1976d2;
    }

    .tag-tipo {
      background: #f3e5f5;
      color: #7b1fa2;
    }

    .tag-salario {
      background: #e8f5e9;
      color: #388e3c;
    }

    .tag-ubicacion {
      background: #fff3e0;
      color: #f57c00;
    }

    .vacante-descripcion {
      color: #555;
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 15px;
    }

    .vacante-requisitos {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .vacante-requisitos h4 {
      color: #333;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .vacante-requisitos ul {
      list-style: none;
      padding-left: 0;
    }

    .vacante-requisitos li {
      color: #666;
      font-size: 13px;
      padding: 5px 0;
      padding-left: 20px;
      position: relative;
    }

    .vacante-requisitos li:before {
      content: "✓";
      position: absolute;
      left: 0;
      color: #2a5298;
      font-weight: bold;
    }

    .vacante-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 15px;
      border-top: 1px solid #f0f0f0;
    }

    .vacante-fecha {
      color: #999;
      font-size: 13px;
    }

    .btn-postular {
      padding: 12px 30px;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-postular:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .no-vacantes {
      background: white;
      border-radius: 15px;
      padding: 60px 40px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .no-vacantes-icon {
      font-size: 64px;
      margin-bottom: 20px;
    }

    .no-vacantes h3 {
      color: #1e3c72;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .no-vacantes p {
      color: #666;
      font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .main-content {
        grid-template-columns: 1fr;
      }

      .filters-sidebar {
        position: static;
      }
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 20px;
      }

      .vacante-header {
        flex-direction: column;
        gap: 15px;
      }

      .vacante-footer {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
      }

      .btn-postular {
        width: 100%;
        text-align: center;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Contenido Principal -->
  <main class="main-content"><!-- Sidebar de Filtros -->
   <aside class="filters-sidebar">
    <div class="filters-header"><span style="font-size: 24px;">🔍</span>
     <h2>Filtros</h2>
    </div>
    <form method="GET" action="">
     <div class="filter-group"><label for="carrera">Carrera</label> <select name="carrera" id="carrera"> <option value="">Todas las carreras</option> <!-- Aquí tu código PHP cargará las carreras desde la tabla Carrera --> </select>
     </div>
     <div class="filter-group"><label for="modalidad">Modalidad</label> <select name="modalidad" id="modalidad"> <option value="">Todas</option> <option value="presencial">Presencial</option> <option value="remoto">Remoto</option> <option value="hibrido">Híbrido</option> </select>
     </div>
     <div class="filter-group"><label for="ubicacion">Ubicación</label> <input type="text" name="ubicacion" id="ubicacion" placeholder="Ciudad o estado">
     </div>
     <div class="filter-group"><label for="salario">Salario Mínimo</label> <select name="salario" id="salario"> <option value="">Cualquier salario</option> <option value="5000">$5,000+</option> <option value="10000">$10,000+</option> <option value="15000">$15,000+</option> <option value="20000">$20,000+</option> </select>
     </div><button type="submit" class="btn-filter">Aplicar Filtros</button> <button type="reset" class="btn-clear">Limpiar Filtros</button>
    </form>
   </aside><!-- Área de Vacantes -->
   <section class="vacantes-area">
    <div class="vacantes-header">
     <h1>💼 Vacantes Disponibles</h1>
     <p class="vacantes-count"><!-- Aquí tu código PHP mostrará el conteo: Mostrando X vacantes activas --></p>
    </div><!-- Aquí tu código PHP generará las tarjetas de vacantes con un loop --> <!-- Ejemplo de estructura para cada vacante:
      
      <article class="vacante-card">
        <div class="vacante-header">
          <div class="vacante-title-area">
            <h3 class="vacante-title"><?php echo $vacante['titulo']; ?></h3>
            <p class="vacante-empresa">🏢 <?php echo $vacante['nombreEmpresa']; ?></p>
          </div>
          <div class="vacante-logo"><?php echo substr($vacante['nombreEmpresa'], 0, 2); ?></div>
        </div>

        <div class="vacante-tags">
          <span class="tag tag-modalidad">💻 <?php echo $vacante['modalidad']; ?></span>
          <span class="tag tag-tipo">⏰ <?php echo $vacante['tipoContrato']; ?></span>
          <span class="tag tag-salario">💰 <?php echo $vacante['salario']; ?></span>
          <span class="tag tag-ubicacion">📍 <?php echo $vacante['ubicacion']; ?></span>
        </div>

        <p class="vacante-descripcion">
          <?php echo $vacante['descripcion']; ?>
        </p>

        <div class="vacante-requisitos">
          <h4>📋 Requisitos:</h4>
          <ul>
            <?php 
            $requisitos = explode('|', $vacante['requisitos']);
            foreach($requisitos as $req) {
              echo "<li>$req</li>";
            }
            ?>
          </ul>
        </div>

        <div class="vacante-footer">
          <span class="vacante-fecha">📅 Publicado <?php echo $vacante['fechaPublicacion']; ?></span>
          <a href="detalle-vacante.php?id=<?php echo $vacante['idVacante']; ?>" class="btn-postular">Ver Detalles</a>
        </div>
      </article>

      --> <!-- Mensaje cuando no hay vacantes --> <!-- 
      <div class="no-vacantes">
        <div class="no-vacantes-icon">📭</div>
        <h3>No se encontraron vacantes</h3>
        <p>Intenta ajustar los filtros de búsqueda para ver más resultados</p>
      </div>
      -->
   </section>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99cb43cca7c6ae76',t:'MTc2MjgzNzYzNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>