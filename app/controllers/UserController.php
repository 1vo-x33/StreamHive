<?php

require_once '../app/services/AuthService.php';

class UserController {
    private $auth;

    public function __construct() {
        $this->auth = new AuthService();
    }

    public function register() {
    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'role' => 'user'
    ];

    $this->auth->register($data);
    header('Location: /streamhive/public/index.php');
}
public function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $this->auth->login($email, $password);

    if (!$user) {
        // login failed, redirect back to login page
        header('Location: /streamhive/public/index.php?action=login');
        return;
    }

    header('Location: /streamhive/public/index.php');
}

public function logout() {
    $this->auth->logout();
    header('Location: /streamhive/public/index.php?action=login');
}
}