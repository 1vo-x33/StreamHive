<?php

// This service sits between the controller and the Comment model.
// The controller talks to this class
class CommentService
{
    private $db;

    private $comment;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->comment = new Comment();
    }

    // Returns all comments for one video by asking the Comment model.
    public function getByVideo($videoId)
    {
        return $this->comment->findByVideo($videoId);
    }

    // Adds a new comment. $data holds the user id, video id, and text.
    public function add($data) {
        return $this->comment->save($data);
    }

    // Deletes one comment by its id.
    public function delete($id)
    {
        return $this->comment->delete($id);
    }
}
