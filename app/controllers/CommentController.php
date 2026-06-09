<?php

require_once __DIR__ . '/../services/CommentService.php';

// Handles incoming requests for comments
// Talks to CommentService which handles the logic
class CommentController
{
    private $commentService;

    // Create a CommentService instance so we can use it in our methods
    public function __construct()
    {
        $this->commentService = new CommentService();
    }

    // Runs when the comment form is submitted
    public function store()
    {
        // Start session so we can access $_SESSION['id']
        session_start();

        // Check if user is logged in, if not redirect to login
        if (!isset($_SESSION['id'])) {
            header('Location: /streamhive/public/index.php?action=login');
            return;
        }

        // Package the form data and session data into one array
        $data = [
            'user_id'  => $_SESSION['id'],        // who is posting
            'video_id' => $_POST['video_id'],      // which video
            'content'  => $_POST['content']        // what they typed
        ];

        // Pass the data to the service which saves it to the database
        $this->commentService->add($data);

        // Redirect back to the video page after posting
        header('Location: /streamhive/public/index.php?action=video&id=' . $_POST['video_id']);
    }

    public function destroy($id)
    {
        // Get the video_id from the URL so we can redirect back after deleting
        $videoId = $_GET['video_id'];

        $this->commentService->delete($id);

        header('Location: /streamhive/public/index.php?action=video&id=' . $videoId);
    }
}