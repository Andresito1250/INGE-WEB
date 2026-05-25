<?php

$page = $_GET['page'] ?? 'login';

switch($page){

    case 'dashboard':
        require 'public/dashboard.php';
        break;

    case 'registro':
        require 'public/registro.php';
        break;

    default:
        require 'public/login.php';
        break;
}
?>