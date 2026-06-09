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
        // Join users so we also get the uploader's email (used by the video page).
        return $this->db->fetchOne(
            "SELECT videos.*, users.email FROM videos JOIN users ON videos.user_id = users.id WHERE videos.id = :id",
            [':id' => $id]
        );
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

        // Return the id of the video we just created so the caller can link a category to it.
        return $this->db->lastInsertId();
    }

    // Adds 1 to the view count of a video. Called each time someone opens the video page.
    public function incrementViews($id)
    {
        $this->db->query("UPDATE videos SET views = views + 1 WHERE id = :id", [':id' => $id]);
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM videos WHERE id = :id", [':id' => $id]);
    }
}

?>