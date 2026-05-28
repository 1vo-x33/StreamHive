<?php

require_once '../core/Database.php';
require_once '../app/models/User.php';
require_once '../app/services/AuthService.php';
require_once '../app/controllers/UserController.php';

$action = $_GET['action'] ?? 'home';

$controller = new UserController();

if ($action == 'register') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller->register();
    } else {
        require_once '../views/register.php';
    }
} else if ($action == 'login') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller->login();
    } else {
        require_once '../views/login.php';
    }
} else if ($action == 'logout') {
    $controller->logout();
} else {
    // show homepage
}






?>