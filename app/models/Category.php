<?php

// This class handles categories: listing them, linking them to videos, and reading them back.
class Category
{
    // Holds the database connection so we can run queries.
    private $db;

    // Runs when we create a new Category object. Grabs the shared DB connection.
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Returns every category (used to fill the dropdown on the upload form).
    public function findAll()
    {
        return $this->db->fetchAll("SELECT * FROM categories ORDER BY name");
    }

    // Links a video to a category by adding a row in the video_category join table.
    public function assignToVideo($videoId, $categoryId)
    {
        $this->db->query(
            "INSERT INTO video_category (video_id, category_id) VALUES (:video_id, :category_id)",
            [':video_id' => $videoId, ':category_id' => $categoryId]
        );
    }

    // Returns all categories that belong to one video (used on the video page).
    public function findByVideo($videoId)
    {
        return $this->db->fetchAll(
            "SELECT categories.*
             FROM categories
             JOIN video_category ON categories.id = video_category.category_id
             WHERE video_category.video_id = :video_id",
            [':video_id' => $videoId]
        );
    }
}
