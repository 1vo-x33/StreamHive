<?php

class VideoController
{
    private $videoService;

    public function __construct()
    {
        $this->videoService = new VideoService();
    }

    public function index()
    {
        // get all videos from the service
        $videos = $this->videoService->getAll();

        // load the view that displays all videos
        require_once '../views/home.php';
    }

    // Shows a single video page for the given video id.
    public function show($id)
    {
        // Start the session so we can check who is logged in (used by the view).
        session_start();

        // Ask the service for this one video's data.
        $video = $this->videoService->getById($id);

        // Also get all the comments that belong to this video.
        $commentService = new CommentService();
        $comments = $commentService->getByVideo($id);

        // Get how many likes this video has.
        $likeCount = $this->videoService->getLikeCount($id);

        // Load the page. $video, $comments and $likeCount can be used inside video.php.
        require_once '../views/video.php';
    }

    public function store()
    {
        session_start();

        // get the uploaded file
        $file = $_FILES['video'];

        // get the form data
        $data = [
            'user_id' => $_SESSION['id'], // from session
            'title' => $_POST['title'], // from form
            'description' => $_POST['description'] // from form
        ];

        // upload the video
        $this->videoService->upload($file, $data);

        // redirect to homepage
        header('Location: /streamhive/public/index.php');
    }

    public function destroy($id)
    {
        $this->videoService->delete($id);
        header('Location: /streamhive/public/index.php');
    }

    // Handle like toggle and redirect back to video
    public function toggleLike($userId, $videoId)
    {
        $this->videoService->toggleLike($userId, $videoId);
        header('Location: /streamhive/public/index.php?action=video&id=' . $videoId);
    }
}



?>