<?php

class Like {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Check if a user already liked a video
    public function findByUserAndVideo($userId, $videoId) {
        return $this->db->fetchOne(
            "SELECT * FROM likes WHERE user_id = :user_id AND video_id = :video_id",
            [':user_id' => $userId, ':video_id' => $videoId]
        );
    }

    // Count likes for a video
    public function countByVideo($videoId) {
        $result = $this->db->fetchOne(
            "SELECT COUNT(*) as total FROM likes WHERE video_id = :video_id",
            [':video_id' => $videoId]
        );
        return $result['total'];
    }

    // Save a new like
    public function save($data) {
        $this->db->query(
            "INSERT INTO likes (user_id, video_id) VALUES (:user_id, :video_id)",
            [':user_id' => $data['user_id'], ':video_id' => $data['video_id']]
        );
    }

    // Delete a like (unlike)
    public function delete($userId, $videoId) {
        $this->db->query(
            "DELETE FROM likes WHERE user_id = :user_id AND video_id = :video_id",
            [':user_id' => $userId, ':video_id' => $videoId]
        );
    }
}   