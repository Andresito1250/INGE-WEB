<?php
session_start();
$error = ""; $exito = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../config/database.php');
    require_once('../app/models/Usuario.php');
    require_once('../app/controllers/UserController.php');

    $ctrl = new UserController();
    $res  = $ctrl->create($_POST);

    if (isset($res['error'])) $error = $res['error'];
    else $exito = $res['exito'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>⚡ Mi App Web</h1>
    <span class="header-sub">Crear cuenta nueva</span>
</header>

<main style="display:flex; justify-content:center;">
    <div class="form-wrap fade-up">
        <div style="text-align:center; margin-bottom:28px;">
            <div style="font-size:48px; margin-bottom:12px;">👤</div>
            <h2>Crear cuenta</h2>
            <p class="form-subtitle">Completa el formulario para registrarte</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($exito): ?>
            <div class="alert alert-success">✅ <?= htmlspecialchars($exito) ?>
                <a href="login.php" style="color:var(--accent); margin-left:8px;">Ir al login →</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="registro.php">
            <div>
                <label>Nombre completo</label>
                <input type="text" name="nombre" placeholder="Tu nombre completo" required>
            </div>
            <div>
                <label>Correo electrónico</label>
                <input type="email" name="email" placeholder="correo@ejemplo.com" required>
            </div>
            <div>
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>
            <div>
                <label>Confirmar contraseña</label>
                <input type="password" name="confirmar" placeholder="Repite tu contraseña" required>
            </div>
            <input type="submit" value="Crear cuenta →" style="margin-top:8px;">
        </form>

        <p style="text-align:center; margin-top:20px; font-size:14px; color:var(--muted);">
            ¿Ya tienes cuenta?
            <a href="login.php" style="color:var(--accent);">Inicia sesión</a>
        </p>
    </div>
</main>

<footer><p>&copy; 2025 Mi App Web — Ingeniería Web II</p></footer>
</body>
</html>