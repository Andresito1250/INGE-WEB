<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../models/Usuario.php');

class UserController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    // Crear usuario con seguridad
    public function create($data) {
        // Sanitizar con htmlspecialchars (XSS)
        $nombre   = htmlspecialchars(trim($data['nombre']));
        $email    = htmlspecialchars(trim($data['email']));
        $password = trim($data['password']);

        // Validaciones del lado servidor
        if (empty($nombre) || empty($email) || empty($password)) {
            return ['error' => 'Todos los campos son obligatorios.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'El correo no tiene un formato válido.'];
        }

        if (strlen($password) < 6) {
            return ['error' => 'La contraseña debe tener al menos 6 caracteres.'];
        }

        // Verificar duplicado
        $existe = $this->modelo->buscarPorEmail($email);
        if ($existe) {
            return ['error' => 'Ese correo ya está registrado.'];
        }

        // password_hash para guardar contraseña segura
        $resultado = $this->modelo->crear($nombre, $email, $password);

        if ($resultado) {
            return ['exito' => 'Usuario registrado correctamente.'];
        }
        return ['error' => 'Error al registrar. Intenta de nuevo.'];
    }

    // Leer todos
    public function readAll() {
        return $this->modelo->obtenerTodos();
    }

    // Leer uno
    public function readOne($id) {
        $id = (int)$id; // Casteo para evitar inyección SQL
        return $this->modelo->obtenerPorId($id);
    }

    // Actualizar
    public function update($id, $data) {
        $id     = (int)$id;
        $nombre = htmlspecialchars(trim($data['nombre']));
        $email  = htmlspecialchars(trim($data['email']));

        if (empty($nombre) || empty($email)) {
            return ['error' => 'Todos los campos son obligatorios.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'El correo no tiene un formato válido.'];
        }

        $resultado = $this->modelo->editar($id, $nombre, $email);
        if ($resultado) {
            return ['exito' => 'Usuario actualizado correctamente.'];
        }
        return ['error' => 'Error al actualizar.'];
    }

    // Eliminar
    public function delete($id) {
        $id = (int)$id;
        return $this->modelo->eliminar($id);
    }
}