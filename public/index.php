<?php
session_start();

// Redirigir a login si no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

header("Location: dashboard.php");
exit;