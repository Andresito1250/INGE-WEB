<?php

class AuthController {

    public function login($email, $password) {

        global $conn;

        $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");

        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['usuario'] = $user['id'];

            header("Location: dashboard.php");

            exit;

        } else {

            return "Credenciales inválidas.";

        }
    }
}
?>