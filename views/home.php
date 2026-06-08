<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>StreamHive</title>
</head>
<body>
    <nav>
        <a href="/streamhive/public/index.php">Home</a>
        <a href="/streamhive/public/index.php?action=upload">Upload</a>
        <a href="/streamhive/public/index.php?action=logout">Uitloggen</a>
    </nav>

    <h1>Alle Videos</h1>

    <?php if (empty($videos)): ?>
        <p>Nog geen videos geüpload.</p>
    <?php else: ?>
        <?php foreach ($videos as $video): ?>
            <div>
                <h2><?php echo htmlspecialchars($video['title']); ?></h2> 
                 <!-- prevents XSS attacks by escaping special characters from user input -->
                <p><?php echo htmlspecialchars($video['description']); ?></p>
                <a href="/streamhive/public/index.php?action=video&id=<?php echo $video['id']; ?>">Bekijken</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>