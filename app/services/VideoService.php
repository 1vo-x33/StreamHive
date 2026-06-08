<?php

class VideoService
{
    private $db;
    private $video;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->video = new Video();
    }

    public function upload($file, $data)
    {
        $filename = basename($file['name']); //Gets just the filename from the uploaded file basename() strips any directory path for security.
        $uploadPath = __DIR__ . '/../../public/uploads/' . $filename;

        move_uploaded_file($file['tmp_name'], $uploadPath);

        $this->video->save([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'filename' => $filename
        ]);
    }

    public function getAll()
    {
        return $this->video->findAll();
    }

    public function getById($id)
    {
        return $this->video->findById($id);
    }

    public function delete($id) 
    {
        return $this->video->delete($id);
    }
}
