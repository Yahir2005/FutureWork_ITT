    <?php
  $MessageID = "";
 
  require_once __DIR__ . "/../../usecase/Vacantes/VacanteController.php";
  require_once __DIR__ . "/../../usecase/Postulaciones/PostulacionesController.php";

  $vacanteController = new VacanteController();
  $postulacionesController = new PostulacionesController();
  $listaPostulantes = array();


  // Inicializar contadores en 0 por defecto

  $totalPostulaciones = 0;
  $totalRevision = 0;
  $totalAceptadas = 0;
  $totalEntrevistaProgramada = 0;            


$vacanteId= $_GET['id'];
$vacante = [];
$vacanteEditar= $vacanteController->obtenerVacanteporId($vacanteId);
if($vacanteEditar->status == 'ok'){
    $vacante = $vacanteEditar->body[0];
}else{
    echo $vacanteEditar->message;
}


        // Obtener lista de postulaciones por vacante
      $postulaciones = $postulacionesController->ListarPostulacionesPorVacante($vacanteId);
     if($postulaciones->status == "ok"){
      $listaPostulantes = $postulaciones->body;
     }
  
      // Obtener contadores (asumiendo que los métodos devuelven un objeto con propiedad body)
      $resulttotalpostulaciones = $postulacionesController->contartotalPostulacionesPorVacante($vacanteId);
      $resulttotalRevision = $postulacionesController->contartotalRevisionPorVacante($vacanteId);
      $resulttotalAceptadas = $postulacionesController->contartotalAceptadasPorVacante($vacanteId);
      $resulttotalEntrevistaProgramada = $postulacionesController->contartotalEntrevistaProgramadaPorVacante($vacanteId);

      // Asignar valores si existen
      $totalPostulaciones = $resulttotalpostulaciones->body ?? 0;
      $totalRevision = $resulttotalRevision->body ?? 0;
      $totalAceptadas = $resulttotalAceptadas->body ?? 0;
      $totalEntrevistaProgramada = $resulttotalEntrevistaProgramada->body ?? 0;





?>



<!doctype html>
<html lang="es">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Postulantes de Vacante</title>
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
      box-sizing: border-box;
    }

    html {
      height: 100%;
    }

    /* Header */
    .header {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      padding: 30px 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header-content {
      max-width: 1200px;
      margin: 0 auto;
    }

    .header-text h1 {
      font-size: 32px;
      margin-bottom: 8px;
    }

    .header-text p {
      font-size: 16px;
      opacity: 0.95;
    }

    .btn-back {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 2px solid white;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      background: white;
      color: #2a5298;
    }

    /* Main Container */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px 20px;
    }

    /* Vacancy Info Card */
    .vacancy-info-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }

    .vacancy-title {
      color: #2c3e50;
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .vacancy-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
    }

    .detail-item {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .detail-label {
      color: #6c757d;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .detail-value {
      color: #2c3e50;
      font-size: 15px;
      font-weight: 700;
    }

    /* Stats Cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
      font-size: 40px;
      margin-bottom: 10px;
    }

    .stat-value {
      color: #2c3e50;
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .stat-label {
      color: #6c757d;
      font-size: 14px;
      font-weight: 600;
    }

    /* Filters */
    .filters-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 25px;
    }

    .filters-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      align-items: end;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .filter-label {
      color: #2c3e50;
      font-size: 13px;
      font-weight: 600;
    }

    .filter-select {
      padding: 10px 12px;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      font-size: 14px;
      color: #495057;
      background: white;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select:focus {
      outline: none;
      border-color: #2a5298;
    }

    .btn-filter {
      padding: 10px 20px;
      background: #2a5298;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-filter:hover {
      background: #1e3c72;
    }

    /* Postulantes Table */
    .table-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .table-header {
      padding: 20px 25px;
      border-bottom: 2px solid #e9ecef;
    }

    .table-title {
      color: #2c3e50;
      font-size: 20px;
      font-weight: 700;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: #f8f9fa;
    }

    th {
      padding: 15px 20px;
      text-align: left;
      color: #2c3e50;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 2px solid #e9ecef;
    }

    td {
      padding: 18px 20px;
      color: #495057;
      font-size: 14px;
      border-bottom: 1px solid #e9ecef;
    }

    tbody tr {
      transition: all 0.3s ease;
    }

    tbody tr:hover {
      background: #f8f9fa;
    }

    /* Status Badges */
    .status-badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
    }

    .status-badge.revision {
      background: #fff3cd;
      color: #856404;
    }

    .status-badge.aceptada {
      background: #d4edda;
      color: #155724;
    }

    .status-badge.rechazada {
      background: #f8d7da;
      color: #721c24;
    }

    .status-badge.entrevista {
      background: #d1ecf1;
      color: #0c5460;
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .btn-action {
      padding: 8px 15px;
      border: none;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-view {
      background: #2a5298;
      color: white;
    }

    .btn-view:hover {
      background: #1e3c72;
    }

    .btn-accept {
      background: #28a745;
      color: white;
    }

    .btn-accept:hover {
      background: #218838;
    }

    .btn-reject {
      background: #dc3545;
      color: white;
    }

    .btn-reject:hover {
      background: #c82333;
    }

    .btn-download {
      background: #17a2b8;
      color: white;
    }

    .btn-download:hover {
      background: #138496;
    }

    /* Empty State */
    .empty-state {
      padding: 60px 20px;
      text-align: center;
    }

    .empty-state-icon {
      font-size: 80px;
      margin-bottom: 20px;
      opacity: 0.3;
    }

    .empty-state h3 {
      color: #6c757d;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .empty-state p {
      color: #6c757d;
      font-size: 15px;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .header-text h1 {
        font-size: 24px;
      }

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .filters-grid {
        grid-template-columns: 1fr;
      }

      .table-container {
        overflow-x: scroll;
      }

      table {
        min-width: 800px;
      }

      .action-buttons {
        flex-direction: column;
      }
    }

    @media (max-width: 576px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
    }








  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body><!-- Header -->
  <header class="header">
   <div class="header-content">
    <div class="header-text">
     <h1>👥 Postulantes de la Vacante</h1>
     <p>Gestiona y revisa los candidatos que se han postulado</p>
    </div><a href="?cargar=MisVacantesListView" class="btn-back">← Volver a Mis Vacantes</a>
   </div>
  </header><!-- Main Container -->
  <main class="container"><!-- Vacancy Info -->
   <div class="vacancy-info-card">
    <h2 class="vacancy-title"><?php echo htmlspecialchars($vacante['titulo']); ?></h2>
    <div class="vacancy-details">
     <div class="detail-item"><span class="detail-label">📍 Ubicación</span> <span class="detail-value"><?php echo htmlspecialchars($vacante['ubicacion']); ?></span>
     </div>
     <div class="detail-item"><span class="detail-label">💰 Salario</span> <span class="detail-value">$<?php echo htmlspecialchars($vacante['salario']); ?> MXN</span>
     </div>
     <div class="detail-item"><span class="detail-label">📅 Fecha Publicación</span> <span class="detail-value"><?php echo htmlspecialchars($vacante['fechaPublicacion']); ?></span>
     </div>
     <div class="detail-item"><span class="detail-label">⏰ Fecha Límite</span> <span class="detail-value"><?php echo htmlspecialchars($vacante['fechaLimite']); ?></span>
     </div>
    </div>
   </div><!-- Stats Grid -->
   <div class="stats-grid">
    <div class="stat-card">
     <div class="stat-icon">
      📊
     </div>
     <div class="stat-value">
      <?php echo $totalPostulaciones; ?>
     </div>
     <div class="stat-label">
      Total Postulantes
     </div>
    </div>
    <div class="stat-card">
     <div class="stat-icon">
      🕐
     </div>
     <div class="stat-value">
      <?php echo $totalRevision; ?>
     </div>
     <div class="stat-label">
      En Revisión
     </div>
    </div>
    <div class="stat-card">
     <div class="stat-icon">
      ✅
     </div>
     <div class="stat-value">
      <?php echo $totalAceptadas; ?>
     </div>
     <div class="stat-label">
      Aceptadas
     </div>
    </div>
    <div class="stat-card">
     <div class="stat-icon">
      🎯
     </div>
     <div class="stat-value">
      <?php echo $totalEntrevistaProgramada; ?>
     </div>
     <div class="stat-label">
      En Entrevista
     </div>
    </div>
   </div>

   
   <!-- Postulantes  -->
   <div class="table-card">
    <div class="table-header">
     <h2 class="table-title">Lista de Postulantes</h2>
    </div>
    <div class="table-container">
     <table>
      <thead>
       <tr>
        <th>ID</th>
        <th>Nombre Completo</th>
        <th>Carrera</th>
        <th>Número Control</th>
        <th>Teléfono</th>
        <th>Ubicación</th>
        <th>Fecha Postulación</th>
        <th>Estado</th>
        <th>Acciones</th>
       </tr>
      </thead>
      <tbody>
      <?php if (count($listaPostulantes) > 0): ?>

      <!-- Ejemplo de fila -->
      <?php foreach ($listaPostulantes as $postulante): ?>
       <tr>
        <td><?php echo htmlspecialchars($postulante['idPostulacion']); ?></td>
        <td><strong><?php echo htmlspecialchars($postulante['nombreCompleto']); ?></strong><br><small style="color: #6c757d;"><?php echo htmlspecialchars($postulante['email']); ?></small></td>
        <td><?php echo htmlspecialchars($postulante['nombreCarrera']); ?></td>
        <td><?php echo htmlspecialchars($postulante['numeroControl']); ?></td>
        <td><?php echo htmlspecialchars($postulante['telefono']); ?></td>
        <td><?php echo htmlspecialchars($postulante['ubicacion']); ?></td>
        <td><?php echo htmlspecialchars($postulante['fechaPostulacion']); ?></td>
        <td><span class="status-badge revision"><?php echo htmlspecialchars($postulante['estadoPostulacion']); ?></span></td>
        <td>
         <div class="action-buttons">
         <a href="uploads/cv_20240001.pdf" class="btn-action btn-download" download>📄 CV</a> 
         
         </div></td>
       </tr>
      <?php endforeach; ?>
    <?php else: ?>
       
            <tr>
              <td colspan="9">
                <div class="empty-state">
                  <div class="empty-state-icon">📭</div>
                  <h3>No hay postulantes aún</h3>
                  <p>Esta vacante aún no ha recibido postulaciones</p>
                </div>
              </td>
            </tr>
            
    <?php endif; ?>

      </tbody>
     </table>
    </div>
   </div>
  </main>
  <script>
    function aplicarFiltros() {
      const estado = document.getElementById('filterEstado').value;
      const carrera = document.getElementById('filterCarrera').value;
      const orden = document.getElementById('filterOrden').value;

      // En producción, realizar petición AJAX o recargar página con parámetros
      console.log('Filtros aplicados:', { estado, carrera, orden });
      
      // Simular filtrado
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        let mostrar = true;

        // Filtrar por estado
        if (estado) {
          const estadoBadge = row.querySelector('.status-badge');
          if (estadoBadge && !estadoBadge.textContent.includes(estado)) {
            mostrar = false;
          }
        }

        row.style.display = mostrar ? '' : 'none';
      });
    }

    function cambiarEstado(idPostulacion, nuevoEstado) {
      // Mostrar confirmación inline
      const confirmar = confirm(`¿Estás seguro de cambiar el estado a "${nuevoEstado}"?`);
      
      if (confirmar) {
        // En producción, enviar petición al servidor
        console.log(`Cambiar estado de postulación ${idPostulacion} a ${nuevoEstado}`);
        
        // Simular cambio de estado
        alert(`Estado cambiado a: ${nuevoEstado}`);
        
        // Recargar página o actualizar fila
        // location.reload();
      }
    }

    // Export to Excel function
    function exportarExcel() {
      alert('Exportando lista de postulantes a Excel...');
      // Implementar exportación real en producción
    }
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FutureWork ITT - Postulantes de Vacante</title>
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
      box-sizing: border-box;
    }

    html {
      height: 100%;
    }

    /* Main Container */
    .form-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 600px;
      width: 100%;
      overflow: hidden;
    }

    /* Header */
    .form-header {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      padding: 40px 30px;
      text-align: center;
    }

    .form-header h1 {
      font-size: 28px;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .form-header p {
      font-size: 15px;
      opacity: 0.95;
    }

    /* Form Body */
    .form-body {
      padding: 40px 30px;
    }

    /* Form Group */
    .form-group {
      margin-bottom: 25px;
    }

    .form-label {
      color: #2c3e50;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
    }

    .form-label .required {
      color: #dc3545;
      margin-left: 3px;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      font-size: 15px;
      color: #495057;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: all 0.3s ease;
      background: white;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-help {
      color: #6c757d;
      font-size: 13px;
      margin-top: 5px;
      display: block;
    }

    /* File Input */
    .file-input-wrapper {
      position: relative;
      width: 100%;
    }

    .file-input-label {
      display: block;
      width: 100%;
      padding: 12px 15px;
      border: 2px dashed #e9ecef;
      border-radius: 8px;
      background: #f8f9fa;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      color: #6c757d;
      font-size: 14px;
    }

    .file-input-label:hover {
      border-color: #667eea;
      background: #e9ecef;
    }

    .file-input-label.has-file {
      border-color: #28a745;
      background: #d4edda;
      color: #155724;
    }

    .file-input {
      display: none;
    }

    /* Button */
    .btn-submit {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:disabled {
      background: #6c757d;
      cursor: not-allowed;
      transform: none;
    }

    /* Success Message */
    .success-message {
      background: #d4edda;
      border: 2px solid #28a745;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      display: none;
      text-align: center;
    }

    .success-message.show {
      display: block;
    }

    .success-message h3 {
      color: #155724;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .success-message p {
      color: #155724;
      font-size: 15px;
    }

    /* Error Message */
    .error-message {
      color: #dc3545;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    .error-message.show {
      display: block;
    }

    /* Back Link */
    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .form-header {
        padding: 30px 20px;
      }

      .form-header h1 {
        font-size: 24px;
      }

      .form-body {
        padding: 30px 20px;
      }
    }
  </style>

 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bd02f7447bbf863',t:'MTc2ODI1NzkzOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>