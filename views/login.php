<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen - StreamHive</title>
</head>
<body>
    <h1>Inloggen</h1>

    <form method="POST" action="/streamhive/public/index.php?action=login">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Wachtwoord</label>
        <input type="password" name="password" required>

        <button type="submit">Inloggen</button>
    </form>

    <p>Nog geen account? <a href="/streamhive/public/index.php?action=register">Registreren</a></p>
</body>
</html>