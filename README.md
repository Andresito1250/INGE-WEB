# Proyecto Web — Ingeniería Web II

Aplicación web desarrollada con PHP, MySQL y arquitectura MVC.

## Tecnologías usadas

- HTML5 semántico
- CSS3 con Flexbox (responsive design)
- PHP 8.x (backend)
- MySQL (base de datos)
- PDO (conexión segura)
- Sesiones PHP (autenticación)
- Git + GitHub (control de versiones)

## Estructura del proyecto

proyecto-web/
├── app/
│   ├── controllers/   → AuthController.php, UserController.php
│   ├── models/        → Usuario.php
│   └── views/         → layout.php
├── public/
│   ├── css/           → estilos.css
│   ├── js/
│   ├── index.php
│   ├── login.php
│   ├── dashboard.php
│   ├── registro.php
│   ├── usuarios.php
│   ├── editar.php
│   └── logout.php
├── config/
│   └── database.php
├── router.php
├── .gitignore
└── README.md

## Instalación local

1. Clonar el repositorio en `C:\xampp\htdocs\`
2. Crear la base de datos `webapp` en phpMyAdmin
3. Configurar credenciales en `config/database.php`
4. Abrir `http://localhost/INGE WEB/proyecto-web/public/login.php`

## Seguridad implementada

- Hashing de contraseñas con `password_hash()`
- Sanitización con `htmlspecialchars()` contra XSS
- Consultas preparadas con PDO contra inyección SQL
- Protección de rutas privadas con sesiones
- Regeneración de ID de sesión al autenticarse