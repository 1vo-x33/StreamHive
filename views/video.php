<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Video - StreamHive</title>
    <link rel="stylesheet" href="/streamhive/public/css/style.css">
</head>
<body class="video-page">
    <nav>
        <a href="/streamhive/public/index.php">StreamHive 🐝</a>
        <a href="/streamhive/public/index.php?action=upload">Upload</a>
        <a href="/streamhive/public/index.php?action=logout">Uitloggen</a>
    </nav>

    <h2><?php echo htmlspecialchars($video['title']); ?></h2>
    <p><?php echo htmlspecialchars($video['description']); ?></p>
    <p>Geüpload door: <?php echo htmlspecialchars($video['email']); ?></p>

    <video width="720" controls>
        <source src="/streamhive/public/uploads/<?php echo $video['filename']; ?>" type="video/mp4">
    </video>

    <!-- Small info pills: upload date, views, likes and category. -->
    <div class="badges">
        <span class="badge">📅 <?php echo $video['created_at']; ?></span>
        <span class="badge">👁️ <?php echo $video['views']; ?> keer bekeken</span>
        <span class="badge">❤️ <?php echo $likeCount; ?> likes</span>
        <!-- Categories this video belongs to. $categories comes from VideoController::show(). -->
        <span class="badge">🏷️
            <?php if (empty($categories)): ?>
                geen categorie
            <?php else: ?>
                <?php foreach ($categories as $category): ?>
                    <?php echo htmlspecialchars($category['name']); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </span>
    </div>

    <!-- Like / delete actions -->
    <p>
        <a class="btn" href="/streamhive/public/index.php?action=like&video_id=<?php echo $video['id']; ?>">❤️ Like / Unlike</a>
        <a class="btn btn-danger" href="/streamhive/public/index.php?action=delete&id=<?php echo $video['id']; ?>">Verwijderen</a>
    </p>

    <hr>

    <!-- Comment form -->
    <h3>Reactie plaatsen</h3>
    <form method="POST" action="/streamhive/public/index.php?action=comment_store">
        <!-- Hidden field so the controller knows which video this comment belongs to -->
        <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
        <textarea name="content" placeholder="Schrijf een reactie..." required></textarea>
        <button type="submit">Plaatsen</button>
    </form>

    <hr>

    <!-- Show all comments -->
    <h3>Reacties</h3>
    <?php if (empty($comments)): ?>
        <p>Nog geen reacties.</p>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <strong><?php echo htmlspecialchars($comment['email']); ?></strong>
                <p><?php echo htmlspecialchars($comment['content']); ?></p>
                <small><?php echo $comment['created_at']; ?></small>
                <a href="/streamhive/public/index.php?action=comment_delete&id=<?php echo $comment['id']; ?>&video_id=<?php echo $video['id']; ?>">Verwijderen</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
