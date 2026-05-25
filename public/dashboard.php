<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

require_once('../config/database.php');
require_once('../app/models/Usuario.php');

$modelo = new Usuario();
$total  = count($modelo->obtenerTodos());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1> Mi App Web</h1>
    <span class="header-sub">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?> </span>
</header>

<nav>
    <ul>
        <li><a href="dashboard.php" class="active"> Inicio</a></li>
        <li><a href="usuarios.php"> Usuarios</a></li>
        <li><a href="registro.php"> Agregar</a></li>
        <li><a href="logout.php" style="margin-left:auto; color:var(--danger);"> Salir</a></li>
    </ul>
</nav>

<main class="full" style="padding:0 30px;">
    <div style="margin-bottom:32px;" class="fade-up">
        <h2 style="font-size:28px; margin-bottom:6px;">Panel de Control</h2>
        <p>Gestiona todos los usuarios del sistema desde aquí.</p>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card fade-up">
            <div class="stat-icon"></div>
            <div class="stat-value"><?= $total ?></div>
            <div class="stat-label">Usuarios registrados</div>
        </div>
        <div class="stat-card fade-up">
            <div class="stat-icon"></div>
            <div class="stat-value">1</div>
            <div class="stat-label">Sesión activa</div>
        </div>
        <div class="stat-card fade-up">
            <div class="stat-icon"></div>
            <div class="stat-value">ON</div>
            <div class="stat-label">Seguridad activa</div>
        </div>
        <div class="stat-card fade-up">
            <div class="stat-icon"></div>
            <div class="stat-value">OK</div>
            <div class="stat-label">Base de datos</div>
        </div>
    </div>

    <!-- Acciones rápidas -->
    <div style="display:flex; flex-wrap:wrap; gap:20px; margin-top:8px;">
        <div class="card fade-up" style="flex:1 1 280px;">
            <h3> Gestión de usuarios</h3>
            <p style="margin:10px 0 16px;">Ver, editar y eliminar todos los usuarios registrados en el sistema.</p>
            <a href="usuarios.php" class="btn">Ver usuarios →</a>
        </div>
        <div class="card fade-up" style="flex:1 1 280px;">
            <h3> Nuevo usuario</h3>
            <p style="margin:10px 0 16px;">Registra un nuevo usuario con nombre, correo y contraseña segura.</p>
            <a href="registro.php" class="btn">Agregar usuario →</a>
        </div>
        <div class="card fade-up" style="flex:1 1 280px;">
            <h3> Seguridad</h3>
            <p style="margin:10px 0 16px;">Contraseñas con hash, sesiones protegidas y sanitización activa.</p>
            <span class="badge badge-purple">✓ Protegido</span>
        </div>
    </div>
</main>

<footer><p>&copy; 2025 Mi App Web — Ingeniería Web II</p></footer>
</body>
</html>