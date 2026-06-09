<?php

class Comment
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function save($data)
    {
        // The :placeholders are filled in safely below to prevent SQL injection.
        $this->db->query("INSERT INTO comments (user_id, video_id, content) VALUES (:user_id, :video_id, :content)", [
            ':user_id' => $data['user_id'],
            ':video_id' => $data['video_id'],
            ':content' => $data['content'],
        ]);
    }

    // Gets all comments that belong to one video.
    // Returns a list of rows (each row is one comment plus the author's email).
    public function findByVideo($videoId)
    {
        return $this->db->fetchAll(
        // comments.* = all columns from the comments table.
        // JOIN users = also pull the matching user so we know who wrote each comment.
        "SELECT comments.*, users.email
         FROM comments
         JOIN users ON comments.user_id = users.id
         WHERE comments.video_id = :video_id",
            [':video_id' => $videoId] //The order is always: SELECT → FROM → JOIN → WHERE
        );
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM comments WHERE id = :id", [':id' => $id]);
    }
}
