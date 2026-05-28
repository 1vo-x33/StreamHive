<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren - StreamHive</title>
</head>
<body>
    <h1>Registreren</h1>

    <form method="POST" action="/streamhive/public/index.php?action=register">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Wachtwoord</label>
        <input type="password" name="password" required>

        <button type="submit">Registreren</button>
    </form>

    <p>Al een account? <a href="/streamhive/public/index.php?action=login">Inloggen</a></p>
</body>
</html>