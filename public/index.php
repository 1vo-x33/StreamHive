<?php

require_once '../core/Database.php';
require_once '../app/models/User.php';
require_once '../app/models/Video.php';
require_once '../app/services/AuthService.php';
require_once '../app/services/VideoService.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/VideoController.php';

$action = $_GET['action'] ?? 'home'; 
// Reads ?action= from the URL. If there's no action, defaults to 'home'. So visiting index.php with no action shows the homepage.

$controller = new UserController();
$videoController = new VideoController();

if ($action == 'register') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller->register();
    } else {
        require_once '../views/register.php';
    }
} else if ($action == 'login') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller->login();
    } else {
        require_once '../views/login.php';
    }
} else if ($action == 'logout') {
    $controller->logout();
} else if ($action == 'upload') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // form submitted, process the upload
        $videoController->store();
    } else {
        // just show the upload form
        require_once '../views/upload.php';
    }
} else if ($action == 'video') {
    // show single video page
    $id = $_GET['id'];
    $videoController->show($id);
} else if ($action == 'delete') {
    // delete a video
    $id = $_GET['id'];
    $videoController->destroy($id);
} else {
    // default homepage, show all videos
    $videoController->index();
}
?>