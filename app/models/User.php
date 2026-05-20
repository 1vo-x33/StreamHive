<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findById($id) {
        return $this->db->fetchOne("SELECT * FROM users WHERE id = :id", [':id' => $id]);
    }

    public function findByEmail($email) {
        return $this->db->fetchOne("SELECT * FROM users WHERE email = :email", [':email' => $email]);
    }

    public function save($data) {
        $this->db->query("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)", [
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role']
        ]);
    }

    public function delete($id) {
        $this->db->query("DELETE FROM users WHERE id = :id", [':id' => $id]);
    }
}

?>