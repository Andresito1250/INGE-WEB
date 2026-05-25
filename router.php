<?php

$page = $_GET['page'] ?? 'login';

switch($page){

    case 'dashboard':
        require 'dashboard.php';
        break;

    case 'registro':
        require 'registro.php';
        break;

    default:
        require 'login.php';
        break;
}
?>