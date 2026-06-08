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

    <video width="720" controls>
        <source src="/streamhive/public/uploads/<?php echo $video['filename']; ?>" type="video/mp4">
    </video>

    <p>Geüpload op: <?php echo $video['created_at']; ?></p>

    <a href="/streamhive/public/index.php?action=delete&id=<?php echo $video['id']; ?>">Verwijderen</a>

    <h3>Comments</h3>
    <p>Comments komen later.</p>
</body>
</html>