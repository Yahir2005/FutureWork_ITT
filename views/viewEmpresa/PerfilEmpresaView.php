<?php
  require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";
  require_once __DIR__ . "/../../usecase/Empresa/EmpresaController.php";

  /** Extraer el ID de la empresa */
  $idUsuario = $_SESSION["idUsuarios"] ?? null;
    
  $EmpresaController = new EmpresaController();
  $result = $EmpresaController->obtenerEmpresaPorIdUsuario($idUsuario);
  $datosEmpresa = $result->body ?? [];
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

/* CONTENEDOR MAESTRO (ENCAPSULA EL MODO OSCURO) */
.company-profile-wrapper {
    font-family: 'Inter', sans-serif;
    background: #0b1120;
    color: #ffffff;
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: hidden;
    z-index: 1;
}

/* Forzar color heredado para que Bootstrap no lo rompa */
.company-profile-wrapper h1, 
.company-profile-wrapper h2, 
.company-profile-wrapper h3, 
.company-profile-wrapper h4 {
    color: #ffffff;
}

/* FONDO UIX DE ORBES INTELIGENTES */
.company-profile-wrapper .bg-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    opacity: .32;
    z-index: -1;
    animation: floatOrbCompany 10s ease-in-out infinite;
    pointer-events: none;
}

.company-profile-wrapper .orb-1 {
    width: 320px;
    height: 320px;
    background: #1e3c72;
    top: -60px;
    left: -60px;
}

.company-profile-wrapper .orb-2 {
    width: 360px;
    height: 360px;
    background: #0ea5e9;
    bottom: -100px;
    right: -100px;
}

.company-profile-wrapper .orb-3 {
    width: 260px;
    height: 260px;
    background: #2a5298;
    top: 45%;
    left: 35%;
}

@keyframes floatOrbCompany {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

/* HEADER DEL PERFIL */
.company-header-view {
    padding: 60px 8% 40px 8%;
    position: relative;
}

.company-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
}

.company-header-text {
    flex: 1;
    min-width: 280px;
}

.company-badge-profile {
    display: inline-block;
    padding: 10px 18px;
    background: rgba(255, 255, 255, .08);
    border: 1px solid rgba(255, 255, 255, .12);
    border-radius: 999px;
    margin-bottom: 25px;
    backdrop-filter: blur(12px);
    font-size: 0.9rem;
    animation: fadeUpCompany 0.8s ease;
}

.company-header-text h1 {
    font-size: 3.5rem;
    line-height: 1.1;
    margin-bottom: 20px;
    font-weight: 800;
    animation: fadeUpCompany 1s ease;
}

.company-header-text h1 span {
    background: linear-gradient(90deg, #38bdf8, #2a5298);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.company-header-text p {
    font-size: 1.15rem;
    color: #cbd5e1;
    max-width: 650px;
    line-height: 1.8;
    margin-bottom: 0;
    animation: fadeUpCompany 1.2s ease;
}

/* AVATAR CORPORATIVO 3D */
.hero-avatar-company {
    display: flex;
    justify-content: center;
    align-items: center;
}

.avatar-circle-company {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e3c72, #0ea5e9);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 5.5rem;
    box-shadow: 0 20px 60px rgba(14, 165, 233, .35), inset 0 0 30px rgba(255, 255, 255, .15);
    animation: floatAvatarCompany 6s ease-in-out infinite;
}

@keyframes floatAvatarCompany {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(2deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

/* CONTENEDOR CENTRAL DE LA GRID */
.company-main-container {
    width: 92%;
    max-width: 1450px;
    margin: auto;
    padding-bottom: 80px;
}

.company-profile-grid {
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 30px;
}

/* COMPONENTES DE ALERTAS DE VALIDACIÓN MODERNAS */
.company-alert {
    padding: 16px 24px;
    border-radius: 24px;
    margin-bottom: 35px;
    font-size: 0.95rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid transparent;
}

.company-alert-success {
    background: rgba(34, 197, 94, .12);
    color: #4ade80;
    border-color: rgba(34, 197, 94, .2);
}

.company-alert-warning {
    background: rgba(250, 204, 21, .12);
    color: #fde047;
    border-color: rgba(250, 204, 21, .2);
}

.company-alert-error {
    background: rgba(239, 68, 68, .12);
    color: #fca5a5;
    border-color: rgba(239, 68, 68, .2);
}

/* SIDEBAR CARD */
.company-sidebar-card {
    background: rgba(255, 255, 255, .05);
    border: 1px solid rgba(255, 255, 255, .08);
    backdrop-filter: blur(20px);
    border-radius: 35px;
    padding: 35px;
    position: sticky;
    top: 110px;
    height: max-content;
    transition: .4s;
}

.company-sidebar-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, .3);
}

.company-image-container {
    display: flex;
    justify-content: center;
    margin-bottom: 25px;
}

.company-image-placeholder {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e3c72, #0ea5e9);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.8rem;
    box-shadow: 0 10px 40px rgba(30, 60, 114, .4);
}

.company-title-text {
    font-size: 1.6rem;
    text-align: center;
    margin-bottom: 10px;
    font-weight: 700;
}

.company-sector-sub {
    text-align: center;
    color: #94a3b8;
    margin-bottom: 18px;
    font-size: 0.95rem;
}

.company-validation-badge {
    display: block;
    width: max-content;
    margin: 0 auto 30px;
    padding: 10px 18px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 0.9rem;
}

.badge-aprobada { background: rgba(34, 197, 94, .15); color: #4ade80; }
.badge-pendiente { background: rgba(250, 204, 21, .15); color: #fde047; }
.badge-rechazada { background: rgba(239, 68, 68, .15); color: #fca5a5; }

/* ESTADÍSTICAS DEL SIDEBAR */
.company-profile-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 30px;
}

.company-stat-item {
    background: rgba(255, 255, 255, .05);
    border-radius: 20px;
    padding: 15px;
    text-align: center;
    transition: .4s;
}

.company-stat-item:hover {
    transform: translateY(-5px);
    background: rgba(30, 60, 114, .25);
}

.company-stat-value {
    font-size: 1.8rem;
    margin-bottom: 5px;
    color: #38bdf8;
    font-weight: 700;
}

.company-stat-label {
    color: #cbd5e1;
    font-size: .85rem;
}

/* ACCIONES SIDEBAR */
.company-profile-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.company-btn-action {
    padding: 16px;
    border-radius: 18px;
    text-decoration: none;
    text-align: center;
    font-weight: 600;
    transition: .4s;
    font-size: 0.95rem;
}

.company-btn-primary { background: linear-gradient(135deg, #1e3c72, #38bdf8); color: #fff !important; }
.company-btn-secondary { background: rgba(255, 255, 255, .06); color: #fff !important; border: 1px solid rgba(255, 255, 255, 0.08); }

.company-btn-action:hover {
    transform: translateY(-5px);
}

/* SECCIÓN CENTRAL DE INFORMACIÓN */
.company-info-section {
    display: flex;
    flex-direction: column;
    gap: 28px;
}

/* GLASS CARDS CORPORATIVAS */
.company-info-card {
    background: rgba(255, 255, 255, .05);
    border: 1px solid rgba(255, 255, 255, .08);
    backdrop-filter: blur(20px);
    border-radius: 30px;
    padding: 30px;
    transition: .4s;
    position: relative;
    overflow: hidden;
}

.company-info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
}

.company-info-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding-bottom: 12px;
}

.company-info-card-title {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 0;
}

/* GRILLAS DE INFORMACIÓN INTERNA */
.company-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
}

.company-info-item {
    background: rgba(255, 255, 255, .04);
    border-radius: 20px;
    padding: 20px;
    transition: .4s;
}

.company-info-item:hover {
    transform: translateY(-4px);
    background: rgba(30, 60, 114, .2);
}

.company-info-label {
    display: block;
    margin-bottom: 8px;
    color: #94a3b8;
    font-size: .9rem;
}

.company-info-value {
    font-weight: 600;
    font-size: 0.98rem;
}

.company-info-value a {
    color: #38bdf8;
    text-decoration: none;
    transition: .3s;
}

.company-info-value a:hover {
    color: #ffffff;
}

.company-description-text {
    color: #cbd5e1;
    line-height: 1.8;
    font-size: 1rem;
    margin-bottom: 0;
}

/* ANIMACIONES */
@keyframes fadeUpCompany {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* MEDIA QUERIES PARA RESPONSIVE FLUIDO */
@media(max-width: 1150px) {
    .company-profile-grid {
        grid-template-columns: 1fr;
    }
    .company-sidebar-card {
        position: relative;
        top: 0;
        width: 100%;
    }
}

@media(max-width: 768px) {
    .company-header-text h1 {
        font-size: 2.6rem;
    }
    .avatar-circle-company {
        width: 160px;
        height: 160px;
        font-size: 3.8rem;
    }
    .company-info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="company-profile-wrapper">
  
  <div class="bg-orb orb-1"></div>
  <div class="bg-orb orb-2"></div>
  <div class="bg-orb orb-3"></div>

  <?php if (!empty($datosEmpresa)): ?>
    <?php foreach ($datosEmpresa as $empresa): ?>
      
      <header class="company-header-view">
         <div class="company-header-content">
            <div class="company-header-text">
               <div class="company-badge-profile">
                  ✨ Dashboard Corporativo Klivify
               </div>
               <h1>Perfil de la <span>empresa</span></h1>
               <p>Información completa, validación y credenciales de contacto corporativo.</p>
            </div>

            <div class="hero-avatar-company">
                <div class="avatar-circle-company">
                    🏢
                </div>
            </div>
         </div>
      </header>

      <main class="company-main-container">
         
         

         <div class="company-profile-grid">
            
            <aside class="company-sidebar-card">
               <div class="company-image-container">
                  <div class="company-image-placeholder">
                     🏢
                  </div>
               </div> 
               
               <h2 class="company-title-text">
                  <?php echo htmlspecialchars($empresa['nombreEmpresa'] ?? 'Sin Nombre'); ?>
               </h2>
               
               <p class="company-sector-sub">
                  💼 Sector: <?php echo htmlspecialchars($empresa['sector'] ?? 'No especificado'); ?>
               </p>
                              
               <div class="company-profile-stats">
                  <div class="company-stat-item">
                     <div class="company-stat-value">0</div>
                     <div class="company-stat-label">Vacantes Activas</div>
                  </div>
                  <div class="company-stat-item">
                     <div class="company-stat-value">0</div>
                     <div class="company-stat-label">Postulaciones</div>
                  </div>
               </div>

               <div class="company-profile-actions">
                  <a href="?cargar=MisVacantesListView" class="company-btn-action company-btn-primary">📋 Ver Mis Vacantes</a>
                  <a href="?cargar=VacantesAddView" class="company-btn-action company-btn-secondary">➕ Publicar Vacante</a>
               </div>
            </aside>

            <div class="company-info-section">
               
               <div class="company-info-card">
                  <div class="company-info-card-header">
                     <h3 class="company-info-card-title">📊 Información General</h3>
                  </div>

                  <div class="company-info-grid">
                     <div class="company-info-item">
                        <span class="company-info-label">ID de Empresa</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['idEmpresas']); ?></span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Representante Legal</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['representante'] ?? 'No registrado'); ?></span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Sitio Web Corporativo</span> 
                        <span class="company-info-value"> 
                           <?php if(!empty($empresa['sitioWeb'])): ?>
                              <a href="<?php echo htmlspecialchars($empresa['sitioWeb']); ?>" target="_blank" rel="noopener noreferrer"> 🌐 Visitar sitio oficial </a> 
                           <?php else: ?>
                              No disponible
                           <?php endif; ?>
                        </span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Sector Industrial</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['sector'] ?? 'No registrado'); ?></span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Estado de Validación</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['estadoValidacionEmpresa'] ?? 'Pendiente'); ?></span>
                     </div>
                  </div>
               </div>

               <div class="company-info-card">
                  <div class="company-info-card-header">
                     <h3 class="company-info-card-title">📝 Acerca de <?php echo htmlspecialchars($empresa['nombreEmpresa'] ?? 'la empresa'); ?></h3>
                  </div>
                  <p class="company-description-text">
                     <?php echo nl2br(htmlspecialchars($empresa['descripcion'] ?? 'Sin descripción disponible.')); ?>
                  </p>
               </div>

               <div class="company-info-card">
                  <div class="company-info-card-header">
                     <h3 class="company-info-card-title">📧 Información de Contacto</h3>
                  </div>
                  
                  <div class="company-info-grid">
                     <div class="company-info-item">
                        <span class="company-info-label">Nombre de Contacto</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['nombreCompleto'] ?? 'No disponible'); ?></span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Correo Electrónico</span> 
                        <span class="company-info-value"> 
                           <a href="mailto:<?php echo htmlspecialchars($empresa['email'] ?? ''); ?>">📧 <?php echo htmlspecialchars($empresa['email'] ?? 'No disponible'); ?></a> 
                        </span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">ID de Usuario</span> 
                        <span class="company-info-value"><?php echo htmlspecialchars($empresa['idUsuarios'] ?? 'No disponible'); ?></span>
                     </div>
                     
                     <div class="company-info-item">
                        <span class="company-info-label">Tipo de Cuenta</span> 
                        <span class="company-info-value">👤 Empresa</span>
                     </div>
                  </div>
               </div>

            </div> </div> </main>

    <?php endforeach; ?>
  <?php else: ?>
      <div class="company-main-container text-center py-5">
          <div class="company-info-card p-5" style="background: rgba(255,255,255,.05); border-radius:30px;">
              <h2 class="text-white">⚠️ Perfil no encontrado</h2>
              <p class="text-secondary">No se encontraron datos registrados para esta empresa asociada a tu usuario.</p>
          </div>
      </div>
  <?php endif; ?>

</div>