<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

require_once('../config/database.php');
require_once('../app/models/Usuario.php');

$modelo = new Usuario();

if (isset($_GET['eliminar'])) {
    $modelo->eliminar((int)$_GET['eliminar']);
    header("Location: usuarios.php?ok=1");
    exit;
}

$usuarios = $modelo->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1> Mi App Web</h1>
    <span class="header-sub">Gestión de usuarios</span>
</header>

<nav>
    <ul>
        <li><a href="dashboard.php"> Inicio</a></li>
        <li><a href="usuarios.php" class="active"> Usuarios</a></li>
        <li><a href="registro.php">Agregar</a></li>
        <li><a href="logout.php" style="margin-left:auto; color:var(--danger);"> Salir</a></li>
    </ul>
</nav>

<main class="full" style="padding:0 30px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;" class="fade-up">
        <div>
            <h2 style="font-size:26px; margin-bottom:4px;">Usuarios registrados</h2>
            <p><?= count($usuarios) ?> usuarios en el sistema</p>
        </div>
        <a href="registro.php" class="btn">+ Nuevo usuario</a>
    </div>

    <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success fade-up">✅ Usuario eliminado correctamente.</div>
    <?php endif; ?>

    <div class="table-wrap fade-up">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><span class="badge badge-purple"><?= $u['id'] ?></span></td>
                    <td><strong><?= htmlspecialchars($u['nombre']) ?></strong></td>
                    <td style="color:var(--muted);"><?= htmlspecialchars($u['email']) ?></td>
                    <td style="color:var(--muted); font-size:13px;"><?= $u['created_at'] ?></td>
                    <td style="display:flex; gap:8px;">
                        <a href="editar.php?id=<?= $u['id'] ?>" class="btn btn-edit"> Editar</a>
                        <a href="usuarios.php?eliminar=<?= $u['id'] ?>"
                           class="btn btn-danger"
                           onclick="return confirm('¿Eliminar este usuario?')"> Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px; color:var(--muted);">
                        No hay usuarios registrados aún.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<footer><p>&copy; 2025 Mi App Web — Ingeniería Web II</p></footer>
</body>
</html>