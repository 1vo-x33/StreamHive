<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren - StreamHive</title>
    <link rel="stylesheet" href="/streamhive/public/css/style.css">
</head>
<body class="auth">
    <h1>StreamHive 🐝</h1>
    <h2>Registreren</h2>

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