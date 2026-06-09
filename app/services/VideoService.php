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

    // Toggle like — if already liked, unlike. If not liked, like.
    public function toggleLike($userId, $videoId)
    {
        $like = new Like();
        $existing = $like->findByUserAndVideo($userId, $videoId);

        if ($existing) {
            // already liked, so unlike
            $like->delete($userId, $videoId);
        } else {
            // not liked yet, so like
            $like->save(['user_id' => $userId, 'video_id' => $videoId]);
        }
    }

    // Get total likes for a video
    public function getLikeCount($videoId)
    {
        $like = new Like();
        return $like->countByVideo($videoId);
    }
}
