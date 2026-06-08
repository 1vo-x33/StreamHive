<?php

class Video
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findById($id)
    {
        return $this->db->fetchOne("SELECT * FROM videos WHERE id = :id", [':id' => $id]);
    }

    public function findAll()
    { {
            return $this->db->fetchAll("SELECT videos.*, users.email FROM videos JOIN users ON videos.user_id = users.id");
        }
    }

    public function save($data)
    {
        $this->db->query("INSERT INTO videos (user_id, title, description, filename) VALUES (:user_id, :title, :description, :filename)", [
            ':user_id' => $data['user_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':filename' => $data['filename']
        ]);
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM videos WHERE id = :id", [':id' => $id]);
    }
}

?>