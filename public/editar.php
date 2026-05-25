<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

require_once('../config/database.php');
require_once('../app/models/Usuario.php');
require_once('../app/controllers/UserController.php');

$ctrl    = new UserController();
$error   = ""; $exito = "";
$id      = (int)($_GET['id'] ?? 0);
$usuario = $ctrl->readOne($id);

if (!$usuario) { header("Location: usuarios.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res = $ctrl->update($id, $_POST);
    if (isset($res['error'])) $error = $res['error'];
    else {
        $exito   = $res['exito'];
        $usuario = $ctrl->readOne($id);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1> Mi App Web</h1>
    <span class="header-sub">Editando usuario</span>
</header>

<nav>
    <ul>
        <li><a href="dashboard.php"> Inicio</a></li>
        <li><a href="usuarios.php"> Usuarios</a></li>
        <li><a href="logout.php" style="margin-left:auto; color:var(--danger);"> Salir</a></li>
    </ul>
</nav>

<main style="display:flex; justify-content:center;">
    <div class="form-wrap fade-up">
        <div style="text-align:center; margin-bottom:28px;">
            <div style="font-size:48px; margin-bottom:12px;"></div>
            <h2>Editar usuario</h2>
            <p class="form-subtitle">Modifica los datos del usuario</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"> <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($exito): ?>
            <div class="alert alert-success"> <?= htmlspecialchars($exito) ?></div>
        <?php endif; ?>

        <form method="POST" action="editar.php?id=<?= $id ?>">
            <div>
                <label>Nombre</label>
                <input type="text" name="nombre"
                       value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>
            <div>
                <label>Correo electrónico</label>
                <input type="email" name="email"
                       value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>
            <input type="submit" value="Guardar cambios →" style="margin-top:8px;">
        </form>

        <p style="text-align:center; margin-top:20px; font-size:14px;">
            <a href="usuarios.php" style="color:var(--muted);">← Volver a la lista</a>
        </p>
    </div>
</main>

<footer><p>&copy; 2025 Mi App Web — Ingeniería Web II</p></footer>
</body>
</html>