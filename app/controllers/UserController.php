<?php

require_once '../app/services/AuthService.php';

class UserController {
    private $auth;

    public function __construct() {
        $this->auth = new AuthService();
    }
}