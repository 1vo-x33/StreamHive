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

    public function show($id)
    {
        //get one video by id
        $video = $this->videoService->getById($id);

        //load views/video.php
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
}



?>