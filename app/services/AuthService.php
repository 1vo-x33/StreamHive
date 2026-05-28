<?php
require_once __DIR__ . '/../models/User.php';
class AuthService
{
    private $db;
    private $user;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->user = new User();
    }

    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->user->save($data);

        $newUser = $this->user->findByEmail($data['email']);
        

        session_start();
        $_SESSION['id'] = $newUser['id'];
        $_SESSION['role'] = $newUser['role'];

        return $newUser;
    }


    public function login($email, $password) {
    $user = $this->user->findByEmail($email);
    
    if (!$user || !password_verify($password, $user['password'])) {
        return false;
    }
    
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    
    return $user;
    }
    public function logout() {
    session_start();
    session_destroy();
    }
    
    public function currentUser() {
    session_start();
    if (isset($_SESSION['id'])) {
        return $this->user->findById($_SESSION['id']);
    }
    return null;
}
}

