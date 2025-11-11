<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Empresas</title>
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

    /* Área de Empresas */
    .empresas-area {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .empresas-header {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .empresas-header h1 {
      color: #1e3c72;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .empresas-count {
      color: #666;
      font-size: 15px;
    }

    /* Grid de Empresas */
    .empresas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 25px;
    }

    /* Tarjetas de Empresas */
    .empresa-card {
      background: white;
      border-radius: 15px;
      padding: 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .empresa-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .empresa-header {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      padding: 30px;
      text-align: center;
      position: relative;
    }

    .empresa-logo {
      width: 100px;
      height: 100px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      font-size: 36px;
      font-weight: bold;
      color: #1e3c72;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .empresa-nombre {
      color: white;
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .empresa-sector {
      color: rgba(255, 255, 255, 0.9);
      font-size: 14px;
      display: inline-block;
      padding: 6px 16px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
    }

    .empresa-body {
      padding: 25px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .empresa-descripcion {
      color: #555;
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 20px;
      flex: 1;
    }

    .empresa-info {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 20px;
    }

    .info-item {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #666;
      font-size: 14px;
    }

    .info-icon {
      width: 32px;
      height: 32px;
      background: #f0f4ff;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
    }

    .empresa-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      color: #1e3c72;
      font-size: 24px;
      font-weight: 700;
      display: block;
    }

    .stat-label {
      color: #666;
      font-size: 12px;
      margin-top: 5px;
    }

    .empresa-footer {
      display: flex;
      gap: 10px;
    }

    .btn-ver-perfil {
      flex: 1;
      padding: 12px;
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
      text-align: center;
    }

    .btn-ver-perfil:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
    }

    .btn-ver-vacantes {
      flex: 1;
      padding: 12px;
      background: white;
      color: #1e3c72;
      border: 2px solid #1e3c72;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }

    .btn-ver-vacantes:hover {
      background: #f0f4ff;
    }

    .no-empresas {
      background: white;
      border-radius: 15px;
      padding: 60px 40px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .no-empresas-icon {
      font-size: 64px;
      margin-bottom: 20px;
    }

    .no-empresas h3 {
      color: #1e3c72;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .no-empresas p {
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

      .empresas-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 20px;
      }

      .empresas-grid {
        grid-template-columns: 1fr;
      }

      .empresa-footer {
        flex-direction: column;
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
     <div class="filter-group"><label for="sector">Sector</label> <select name="sector" id="sector"> <option value="">Todos los sectores</option> <option value="tecnologia">Tecnología</option> <option value="manufactura">Manufactura</option> <option value="automotriz">Automotriz</option> <option value="textil">Textil</option> <option value="alimentos">Alimentos</option> <option value="servicios">Servicios</option> <option value="construccion">Construcción</option> <option value="comercio">Comercio</option> </select>
     </div>
     <div class="filter-group"><label for="ubicacion">Ubicación</label> <input type="text" name="ubicacion" id="ubicacion" placeholder="Ciudad o estado">
     </div>
     <div class="filter-group"><label for="buscar">Buscar empresa</label> <input type="text" name="buscar" id="buscar" placeholder="Nombre de la empresa">
     </div><button type="submit" class="btn-filter">Aplicar Filtros</button> <button type="reset" class="btn-clear">Limpiar Filtros</button>
    </form>
   </aside><!-- Área de Empresas -->
   <section class="empresas-area">
    <div class="empresas-header">
     <h1>🏢 Empresas Asociadas</h1>
     <p class="empresas-count"><!-- Aquí tu código PHP mostrará el conteo: Mostrando X empresas --></p>
    </div><!-- Grid de Empresas -->
    <div class="empresas-grid"><!-- Aquí tu código PHP generará las tarjetas de empresas con un loop --> <!-- Ejemplo de estructura para cada empresa:
        
        <article class="empresa-card">
          <div class="empresa-header">
            <div class="empresa-logo">
              <?php 
              // Si hay imagen de perfil, mostrarla
              // Si no, mostrar iniciales
              echo substr($empresa['nombreEmpresa'], 0, 2); 
              ?>
            </div>
            <h3 class="empresa-nombre"><?php echo $empresa['nombreEmpresa']; ?></h3>
            <span class="empresa-sector"><?php echo $empresa['sector']; ?></span>
          </div>

          <div class="empresa-body">
            <p class="empresa-descripcion">
              <?php echo substr($empresa['descripcion'], 0, 150) . '...'; ?>
            </p>

            <div class="empresa-info">
              <div class="info-item">
                <div class="info-icon">🌐</div>
                <span><?php echo $empresa['sitioWeb']; ?></span>
              </div>
              <div class="info-item">
                <div class="info-icon">👤</div>
                <span><?php echo $empresa['representante']; ?></span>
              </div>
            </div>

            <div class="empresa-stats">
              <div class="stat-item">
                <span class="stat-number"><?php echo $totalVacantes; ?></span>
                <span class="stat-label">Vacantes Activas</span>
              </div>
              <div class="stat-item">
                <span class="stat-number"><?php echo $totalPostulaciones; ?></span>
                <span class="stat-label">Postulaciones</span>
              </div>
            </div>

            <div class="empresa-footer">
              <a href="detalle-empresa.php?id=<?php echo $empresa['idEmpresas']; ?>" class="btn-ver-perfil">Ver Perfil</a>
              <a href="vacantes.php?empresa=<?php echo $empresa['idEmpresas']; ?>" class="btn-ver-vacantes">Ver Vacantes</a>
            </div>
          </div>
        </article>

        -->
    </div><!-- Mensaje cuando no hay empresas --> <!-- 
      <div class="no-empresas">
        <div class="no-empresas-icon">🏢</div>
        <h3>No se encontraron empresas</h3>
        <p>Intenta ajustar los filtros de búsqueda para ver más resultados</p>
      </div>
      -->
   </section>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99cb48ed86c3ae76',t:'MTc2MjgzNzg0NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>