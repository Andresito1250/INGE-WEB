<?php
require_once(__DIR__ . '/../../config/database.php');

class Usuario {

    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $stmt = $this->conn->query("SELECT id, nombre, email, created_at FROM usuarios");
        return $stmt->fetchAll();
    }

    // Obtener un usuario por ID
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Buscar usuario por email (para login)
    public function buscarPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Crear usuario
    public function crear($nombre, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare(
            "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$nombre, $email, $hash]);
    }

    // Editar usuario
    public function editar($id, $nombre, $email) {
        $stmt = $this->conn->prepare(
            "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?"
        );
        return $stmt->execute([$nombre, $email, $id]);
    }

    // Eliminar usuario
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}