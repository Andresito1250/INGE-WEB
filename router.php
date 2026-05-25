<?php
// Router simple — redirige la raíz al login
header("Location: /login.php");
exit;
// Router principal — define qué controlador y acción ejecutar

$request = $_SERVER['REQUEST_URI'];

// Limpiar la URL base del proyecto
$base    = '/INGE WEB/proyecto-web/public/';
$request = str_replace($base, '', $request);
$request = strtok($request, '?'); // quitar parámetros GET

switch ($request) {
    case '':
    case 'index.php':
        require_once(__DIR__ . '/app/views/layout.php');
        break;

    case 'login.php':
        require_once(__DIR__ . '/public/login.php');
        break;

    case 'dashboard.php':
        require_once(__DIR__ . '/public/dashboard.php');
        break;

    case 'usuarios.php':
        require_once(__DIR__ . '/public/usuarios.php');
        break;

    case 'registro.php':
        require_once(__DIR__ . '/public/registro.php');
        break;

    case 'editar.php':
        require_once(__DIR__ . '/public/editar.php');
        break;

    case 'logout.php':
        require_once(__DIR__ . '/public/logout.php');
        break;

    default:
        http_response_code(404);
        echo "<h1>404 — Página no encontrada</h1>";
        break;
}