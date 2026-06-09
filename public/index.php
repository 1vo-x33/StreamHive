<?php

require_once '../core/Database.php';
require_once '../app/models/User.php';
require_once '../app/models/Video.php';
require_once '../app/models/Comment.php';
require_once '../app/models/Like.php';
require_once '../app/models/Category.php';
require_once '../app/services/AuthService.php';
require_once '../app/services/VideoService.php';
require_once '../app/services/CommentService.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/VideoController.php';
require_once '../app/controllers/CommentController.php';

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
        // just show the upload form (with categories for the dropdown)
        $videoController->create();
    }
} else if ($action == 'video') {
    // show single video page
    $id = $_GET['id'];
    $videoController->show($id);
} else if ($action == 'delete') {
    // delete a video
    $id = $_GET['id'];
    $videoController->destroy($id);
} else if ($action == 'comment_store') {
    // User submitted the comment form
    // We require the files here because CommentController is only
    // needed for comment actions — no point loading it for every request
    require_once '../app/models/Comment.php';
    require_once '../app/services/CommentService.php';
    require_once '../app/controllers/CommentController.php';

    $commentController = new CommentController();
    $commentController->store();

} else if ($action == 'comment_delete') {
    // User clicked delete on a comment
    require_once '../app/models/Comment.php';
    require_once '../app/services/CommentService.php';
    require_once '../app/controllers/CommentController.php';

    $commentController = new CommentController();
    $id = $_GET['id'];
    $commentController->destroy($id);
} else if ($action == 'like') {
    // User clicked the like button
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: /streamhive/public/index.php?action=login');
        return;
    }
    $videoId = $_GET['video_id'];
    $videoController->toggleLike($_SESSION['id'], $videoId);
} else {
    // default homepage, show all videos
    $videoController->index();
}

?>

<!-- 
The if/else block — the actual router:
Each else if handles one action:

register / login — checks GET or POST. GET = show form, POST = process form
logout — just calls logout, no form needed
upload — GET = show upload form, POST = process the upload
video — grabs id from URL, shows that specific video
delete — grabs id from URL, deletes that video
comment_store — loads comment files only when needed, processes comment form
comment_delete — loads comment files only when needed, deletes comment
else (default) — no action in URL, show homepage
 -->