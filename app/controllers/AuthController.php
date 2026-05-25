<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../models/Usuario.php');

class AuthController {

    public function login($email, $password) {
        // Sanitizar entradas
        $email    = htmlspecialchars(trim($email));
        $password = trim($password);

        $modelo = new Usuario();
        $user   = $modelo->buscarPorEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Regenerar ID de sesión para evitar secuestro de sesión
            session_regenerate_id(true);
            $_SESSION['usuario'] = $user['id'];
            $_SESSION['nombre']  = $user['nombre'];
            header("Location: dashboard.php");
            exit;
        } else {
            return "Credenciales inválidas.";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    public function estaAutenticado() {
        return isset($_SESSION['usuario']);
    }

    public function proteger() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.php");
            exit;
        }
    }
}