<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureWork ITT - Plataforma de Vinculación Laboral</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="header-glass sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 glass-card rounded-2xl flex items-center justify-center">
                        <span class="text-white font-bold text-xl">FW</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gradient">FutureWork ITT</h1>
                        <p class="text-sm text-gray-600 font-medium">Instituto Tecnológico de Tehuacán</p>
                    </div>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden glass-card p-3 rounded-2xl text-gray-700">
                    <span class="text-2xl">☰</span>
                </button>
                
                <div class="hidden md:flex items-center space-x-4">
                    <button id="loginBtn" class="text-[#003B70] hover:text-[#00A7A7] font-semibold text-lg transition-colors duration-300 btn-rotate">Iniciar Sesión</button>
                    <button id="registerBtn" class="btn-primary text-white px-6 py-3 rounded-2xl font-semibold text-lg btn-glow btn-ripple">Registrarse</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <nav id="sidebarNav" class="fixed left-0 top-0 h-full w-24 hover:w-80 bg-gradient-to-b from-[#003B70] via-[#0077C8] to-[#00A7A7] z-40 transition-all duration-500 ease-in-out group shadow-2xl">
        <!-- Logo Section -->
        <div class="flex items-center justify-center h-24 border-b border-white/20">
            <div class="w-14 h-14 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                <span class="text-white font-bold text-xl">FW</span>
            </div>
        </div>
        
        <!-- Navigation Links -->
        <div class="flex flex-col mt-12 space-y-6 px-4">
            <a href="#" id="navInicio" class="nav-link active sidebar-nav-item group/item" data-section="inicio">
                <div class="nav-icon-container">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                </div>
                <span class="nav-text">Inicio</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a href="#vacantes" id="navVacantes" class="nav-link sidebar-nav-item group/item" data-section="vacantes">
                <div class="nav-icon-container">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z"/></svg>
                </div>
                <span class="nav-text">Vacantes</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a href="#empresas" id="navEmpresas" class="nav-link sidebar-nav-item group/item" data-section="empresas">
                <div class="nav-icon-container">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/></svg>
                </div>
                <span class="nav-text">Empresas</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a href="#contacto" id="navContacto" class="nav-link sidebar-nav-item group/item" data-section="contacto">
                <div class="nav-icon-container">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <span class="nav-text">Contacto</span>
                <div class="nav-indicator"></div>
            </a>
        </div>
        
        <!-- Hover Glow Effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
    </nav>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 md:hidden hidden"></div>
    
    <!-- Mobile Sidebar -->
    <nav id="mobileSidebar" class="fixed left-0 top-0 h-full w-80 bg-gradient-to-b from-[#003B70] via-[#0077C8] to-[#00A7A7] z-40 transform -translate-x-full transition-transform duration-300 md:hidden">
        <div class="flex items-center justify-between h-20 px-6 border-b border-white/20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold">FW</span>
                </div>
                <div>
                    <h2 class="text-white font-bold">FutureWork ITT</h2>
                    <p class="text-white/70 text-sm">Navegación</p>
                </div>
            </div>
            <button id="closeMobileSidebar" class="text-white/70 hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </button>
        </div>
        
        <div class="flex flex-col mt-8 space-y-2 px-4">
            <a href="#" class="mobile-nav-link active" data-section="inicio">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                <span>Inicio</span>
            </a>
            
            <a href="#vacantes" class="mobile-nav-link" data-section="vacantes">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z"/></svg>
                <span>Vacantes</span>
            </a>
            
            <a href="#empresas" class="mobile-nav-link" data-section="empresas">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/></svg>
                <span>Empresas</span>
            </a>
            
            <a href="#contacto" class="mobile-nav-link" data-section="contacto">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                <span>Contacto</span>
            </a>
        </div>
        
        <div class="absolute bottom-8 left-4 right-4">
            <div class="border-t border-white/20 pt-6 space-y-4">
                <button id="mobileLoginBtn" class="w-full bg-white/20 backdrop-blur-lg text-white py-3 px-4 rounded-2xl font-semibold transition-all hover:bg-white/30">
                    Iniciar Sesión
                </button>
                <button id="mobileRegisterBtn" class="w-full bg-white text-[#003B70] py-3 px-4 rounded-2xl font-semibold transition-all hover:bg-white/90">
                    Registrarse
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="mainContent" class="pl-24">
        <?php include 'sections/inicio.php'; ?>
        <?php include 'sections/vacantes.php'; ?>
        <?php include 'sections/empresas.php'; ?>
        <?php include 'sections/contacto.php'; ?>
    </main>
    
    <script src="js/main.js"></script>
</body>
</html>