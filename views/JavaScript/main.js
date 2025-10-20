document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
    const closeMobileSidebar = document.getElementById('closeMobileSidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarNavLinks = document.querySelectorAll('#sidebarNav .nav-link');
    const mobileNavLinks = document.querySelectorAll('#mobileSidebar .mobile-nav-link');
    const sections = document.querySelectorAll('#mainContent section');

    // Show the initial section
    const initialSection = document.getElementById('inicio');
    if(initialSection) {
        initialSection.classList.add('active', 'section-slide-in');
    }


    // Function to handle section switching
    function showSection(sectionId) {
        sections.forEach(section => {
            if (section.id === sectionId) {
                section.classList.add('active', 'section-slide-in');
                section.classList.remove('section-fade-out');
            } else {
                section.classList.remove('active', 'section-slide-in');
                section.classList.add('section-fade-out');
            }
        });

        // Update active state for sidebar links
        sidebarNavLinks.forEach(link => {
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Update active state for mobile links
        mobileNavLinks.forEach(link => {
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
        
        // Close mobile sidebar if open
        mobileSidebar.classList.add('-translate-x-full');
        mobileSidebarOverlay.classList.add('hidden');

    }

    // Event listeners for sidebar navigation
    sidebarNavLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const sectionId = this.dataset.section;
            showSection(sectionId);
        });
    });

    // Event listeners for mobile navigation
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const sectionId = this.dataset.section;
            showSection(sectionId);
        });
    });

    // Mobile menu toggle
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function () {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileSidebarOverlay.classList.remove('hidden');
        });
    }

    if (closeMobileSidebar) {
        closeMobileSidebar.addEventListener('click', function () {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarOverlay.classList.add('hidden');
        });
    }

    if (mobileSidebarOverlay) {
        mobileSidebarOverlay.addEventListener('click', function () {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarOverlay.classList.add('hidden');
        });
    }
    
    // Button click handlers (for demonstration)
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const mobileLoginBtn = document.getElementById('mobileLoginBtn');
    const mobileRegisterBtn = document.getElementById('mobileRegisterBtn');
    const getStartedBtn = document.getElementById('getStartedBtn');
    const verVacantesBtn = document.getElementById('verVacantesBtn');

    if(loginBtn) loginBtn.addEventListener('click', () => alert('Iniciar Sesión'));
    if(registerBtn) registerBtn.addEventListener('click', () => alert('Registrarse'));
    if(mobileLoginBtn) mobileLoginBtn.addEventListener('click', () => alert('Iniciar Sesión (móvil)'));
    if(mobileRegisterBtn) mobileRegisterBtn.addEventListener('click', () => alert('Registrarse (móvil)'));
    if(getStartedBtn) getStartedBtn.addEventListener('click', () => showSection('vacantes'));
    if(verVacantesBtn) verVacantesBtn.addEventListener('click', () => showSection('vacantes'));
});