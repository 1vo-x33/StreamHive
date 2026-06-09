<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Video - StreamHive</title>
</head>
<body>
    <nav>
        <a href="/streamhive/public/index.php">Home</a>
        <a href="/streamhive/public/index.php?action=upload">Upload</a>
        <a href="/streamhive/public/index.php?action=logout">Uitloggen</a>
    </nav>

    <h2><?php echo htmlspecialchars($video['title']); ?></h2>
    <p><?php echo htmlspecialchars($video['description']); ?></p>
    <p>Geüpload door: <?php echo htmlspecialchars($video['email']); ?></p>

    <video width="720" controls>
        <source src="/streamhive/public/uploads/<?php echo $video['filename']; ?>" type="video/mp4">
    </video>

    <p>Geüpload op: <?php echo $video['created_at']; ?></p>

    <!-- Like button -->
    <p>❤️ <?php echo $likeCount; ?> likes</p>
    <a href="/streamhive/public/index.php?action=like&video_id=<?php echo $video['id']; ?>">
        Like / Unlike
    </a>

    <a href="/streamhive/public/index.php?action=delete&id=<?php echo $video['id']; ?>">Verwijderen</a>

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
            <div>
                <strong><?php echo htmlspecialchars($comment['email']); ?></strong>
                <p><?php echo htmlspecialchars($comment['content']); ?></p>
                <small><?php echo $comment['created_at']; ?></small>
                <a href="/streamhive/public/index.php?action=comment_delete&id=<?php echo $comment['id']; ?>&video_id=<?php echo $video['id']; ?>">Verwijderen</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
