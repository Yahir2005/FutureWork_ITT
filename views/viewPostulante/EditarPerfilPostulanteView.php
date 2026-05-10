<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../usecase/Usuario/UsuarioController.php";

// Protección de sesión
$idUsuario = $_SESSION["idUsuarios"] ?? null;

if (!$idUsuario) {
    header("Location: /FutureWork_ITT/");
    exit;
}

$usuarioController = new UsuarioController();

$datosUsuario = [];

$resultUsuario = $usuarioController->obtenerUsuarioPorId($idUsuario);

if ($resultUsuario && strtolower($resultUsuario->status ?? '') === "ok") {
    $datosUsuario = (array) $resultUsuario->body;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klivify - Editar Perfil</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/editarperfil.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <!-- Fondo decorativo -->
    <div class="bg-blur blur1"></div>
    <div class="bg-blur blur2"></div>

    <!-- Header -->
    <header class="header">
        <div class="header-content">

            <div class="header-text">
                <h1>✏️ Editar Perfil</h1>
                <p>Actualiza tu información personal y profesional</p>
            </div>

            <a href="?cargar=PerfilPostulanteView" class="btn-back">
                ⬅ Volver al Perfil
            </a>

        </div>
    </header>

    <!-- Main -->
    <main class="container">

        <form method="POST" action="" class="edit-form">

            <!-- Información Personal -->
            <section class="glass-card">
                <div class="card-header">
                    <div class="icon-3d">👤</div>
                    <h2>Información Personal</h2>
                </div>

                <div class="form-grid">

                    <div class="input-group">
                        <label>Nombre Completo</label>
                        <input 
                            type="text"
                            name="nombreCompleto"
                            value="<?php echo htmlspecialchars($datosUsuario['nombreCompleto'] ?? ''); ?>"
                            placeholder="Ingresa tu nombre">
                    </div>

                    <div class="input-group">
                        <label>Correo Electrónico</label>
                        <input 
                            type="email"
                            name="email"
                            value="<?php echo htmlspecialchars($datosUsuario['email'] ?? ''); ?>"
                            placeholder="correo@ejemplo.com">
                    </div>

                    <div class="input-group">
                        <label>Teléfono</label>
                        <input 
                            type="text"
                            name="telefono"
                            value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>"
                            placeholder="2381705916">
                    </div>

                    <div class="input-group">
                        <label>Dirección</label>
                        <input 
                            type="text"
                            name="direccion"
                            placeholder="Tu dirección">
                    </div>

                </div>
            </section>

            <!-- Información Profesional -->
            <section class="glass-card">

                <div class="card-header">
                    <div class="icon-3d">💼</div>
                    <h2>Información Profesional</h2>
                </div>

                <div class="form-grid">

                    <div class="input-group">
                        <label>Habilidades</label>
                        <textarea 
                            name="habilidades"
                            rows="4"
                            placeholder="Ejemplo: HTML, CSS, JavaScript, UI/UX..."></textarea>
                    </div>

                    <div class="input-group">
                        <label>Experiencia Laboral</label>
                        <textarea 
                            name="experiencia"
                            rows="4"
                            placeholder="Describe tu experiencia profesional"></textarea>
                    </div>

                    <div class="input-group">
                        <label>Idiomas</label>
                        <input 
                            type="text"
                            name="idiomas"
                            placeholder="Español, Inglés, Francés...">
                    </div>

                    <div class="input-group">
                        <label>CV</label>
                        <input type="file" name="cv">
                    </div>

                </div>
            </section>

            <!-- Botones -->
            <div class="actions">

                <button type="submit" class="btn-save">
                    💾 Guardar Cambios
                </button>

                <a href="?cargar=PerfilPostulanteView" class="btn-cancel">
                    ❌ Cancelar
                </a>

            </div>

        </form>

    </main>

</body>
</html>