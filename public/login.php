<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


if (isset($_SESSION['usuario'])) { header("Location: dashboard.php"); exit; }

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../config/database.php');
    require_once('../app/models/Usuario.php');
    require_once('../app/controllers/AuthController.php');

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Por favor completa todos los campos.";
    } else {
        $auth = new AuthController();
        $msg  = $auth->login($email, $password);
        if ($msg) $error = $msg;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1> Mi App Web</h1>
    <span class="header-sub">Panel de administración</span>
</header>

<main style="display:flex; justify-content:center; align-items:flex-start;">
    <div class="form-wrap fade-up">
        <div style="text-align:center; margin-bottom:28px;">
            <div style="font-size:48px; margin-bottom:12px;"></div>
            <h2>Bienvenido de vuelta</h2>
            <p class="form-subtitle">Ingresa tus credenciales para continuar</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"> <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div>
                <label>Correo electrónico</label>
                <input type="email" name="email" placeholder="correo@ejemplo.com" required>
            </div>
            <div>
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <input type="submit" value="Iniciar sesión →" style="margin-top:8px;">
        </form>

        <p style="text-align:center; margin-top:20px; font-size:14px; color:var(--muted);">
            ¿No tienes cuenta?
            <a href="registro.php" style="color:var(--accent);">Regístrate aquí</a>
        </p>
    </div>
</main>

<footer><p>&copy; 2025 Mi App Web — Ingeniería Web II</p></footer>
</body>
</html>