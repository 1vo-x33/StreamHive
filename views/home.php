<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>StreamHive</title>
    <link rel="stylesheet" href="/streamhive/public/css/style.css">
</head>
<body>
    <nav>
        <a href="/streamhive/public/index.php">StreamHive 🐝</a>
        <a href="/streamhive/public/index.php?action=upload">Upload</a>
        <a href="/streamhive/public/index.php?action=logout">Uitloggen</a>
    </nav>

    <h1>Alle Videos</h1>

    <?php if (empty($videos)): ?>
        <p>Nog geen videos geüpload.</p>
    <?php else: ?>
        <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="card">
                    <h2><?php echo htmlspecialchars($video['title']); ?></h2>
                    <!-- prevents XSS attacks by escaping special characters from user input -->
                    <p><?php echo htmlspecialchars($video['description']); ?></p>
                    <p>Geüpload door: <?php echo htmlspecialchars($video['email']); ?></p>
                    <a class="btn" href="/streamhive/public/index.php?action=video&id=<?php echo $video['id']; ?>">Bekijken</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>