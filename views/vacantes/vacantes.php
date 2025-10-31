<?php
 require_once "/../Usuario/";
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="../css/styles.css" rel="stylesheet">
<link href="../css/responsive.css" rel="stylesheet">
<section id="vacantes" class="py-32 bg-[#F5F5F5]">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="text-center mb-20">
            <h3 class="text-5xl font-bold text-gradient mb-6">Vacantes Disponibles</h3>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Encuentra la oportunidad perfecta para dar el siguiente paso en tu carrera profesional.</p>
        </div>

        <!-- Job Listings -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Job Card 1 -->
            <div class="glass-card-white rounded-3xl p-8 card-hover">
                <h4 class="text-2xl font-bold text-[#003B70] mb-3">Desarrollador Frontend</h4>
                <p class="text-gray-700 font-semibold mb-4">Empresa Tech Solutions</p>
                <p class="text-gray-600 mb-6">Buscamos un desarrollador Frontend con experiencia en React y Tailwind CSS para unirse a nuestro equipo innovador.</p>
                <button class="btn-primary text-white px-6 py-3 rounded-xl font-semibold">Ver Detalles</button>
            </div>
            <!-- Job Card 2 -->
            <div class="glass-card-white rounded-3xl p-8 card-hover">
                <h4 class="text-2xl font-bold text-[#003B70] mb-3">Ingeniero de Software Backend</h4>
                <p class="text-gray-700 font-semibold mb-4">Innovate Corp</p>
                <p class="text-gray-600 mb-6">Oportunidad para un ingeniero de software Backend con sólidos conocimientos en Node.js, Express y bases de datos SQL.</p>
                <button class="btn-primary text-white px-6 py-3 rounded-xl font-semibold">Ver Detalles</button>
            </div>
            <!-- Job Card 3 -->
            <div class="glass-card-white rounded-3xl p-8 card-hover">
                <h4 class="text-2xl font-bold text-[#003B70] mb-3">Analista de Datos</h4>
                <p class="text-gray-700 font-semibold mb-4">Data Insights</p>
                <p class="text-gray-600 mb-6">Únete a nuestro equipo de análisis de datos y transforma grandes volúmenes de información en decisiones estratégicas.</p>
                <button class="btn-primary text-white px-6 py-3 rounded-xl font-semibold">Ver Detalles</button>
            </div>
        </div>
    </div>
</section>