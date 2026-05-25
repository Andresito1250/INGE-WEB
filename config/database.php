<?php
// Lee las variables de entorno que Railway provee
$host     = getenv('MYSQLHOST')     ?: 'localhost';
$dbname   = getenv('MYSQLDATABASE') ?: 'webapp';
$user     = getenv('MYSQLUSER')     ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: 'root';
$port     = getenv('MYSQLPORT')     ?: '3306';

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}