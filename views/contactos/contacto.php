<?php

?>
<link href="css/styles.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<section id="contacto" class="py-32 gradient-bg text-white">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="text-center mb-20">
            <h3 class="text-5xl font-bold text-gradient-white mb-6">Contacto</h3>
            <p class="text-xl opacity-90 max-w-3xl mx-auto">¿Tienes preguntas o quieres unirte a nuestra red de empresas? Contáctanos.</p>
        </div>

        <div class="max-w-3xl mx-auto glass-card rounded-3xl p-12">
            <form action="#" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-lg font-medium mb-2">Nombre</label>
                        <input type="text" name="name" id="name" class="w-full input-glass rounded-xl p-3 text-white">
                    </div>
                    <div>
                        <label for="email" class="block text-lg font-medium mb-2">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="w-full input-glass rounded-xl p-3 text-white">
                    </div>
                </div>
                <div class="mt-6">
                    <label for="message" class="block text-lg font-medium mb-2">Mensaje</label>
                    <textarea name="message" id="message" rows="4" class="w-full input-glass rounded-xl p-3 text-white"></textarea>
                </div>
                <div class="mt-8 text-center">
                    <button type="submit" class="btn-secondary text-white px-10 py-4 rounded-2xl font-bold text-xl">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
</section>