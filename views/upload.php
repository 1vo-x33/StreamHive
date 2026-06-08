<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Upload Video - StreamHive</title>
</head>
<body>
    <nav>
        <a href="/streamhive/public/index.php">Home</a>
        <a href="/streamhive/public/index.php?action=upload">Upload</a>
        <a href="/streamhive/public/index.php?action=logout">Uitloggen</a>
    </nav>

    <h1>Video Uploaden</h1>

    <form method="POST" action="/streamhive/public/index.php?action=upload" enctype="multipart/form-data">
        <!-- enctype="multipart/form-data" on the form tag. This is required whenever your form uploads files. Without it $_FILES will be empty and the upload won't work. -->
        <label>Titel</label>
        <input type="text" name="title" required>

        <label>Beschrijving</label>
        <textarea name="description"></textarea>

        <label>Video bestand</label>
        <input type="file" name="video" accept="video/*" required>
        <!-- accept="video/*" tells the browser to only show video files when the user opens the file picker. The * means any video format (mp4, avi, mov etc) -->

        <button type="submit">Uploaden</button>
    </form>
</body>
</html>