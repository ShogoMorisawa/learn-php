<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="index">
<?php include __DIR__ . '/partials/navigation.php'; ?>
<div class="container">
<div class="hero">
    <div class="hero-content">
        <h1>Welcome to our PHP App</h1>
        <p>Securely login and manage your account with us</p>
        <div class="hero-buttons">
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                <a class="btn" href="/admin">Admin</a>
                <a class="btn" href="/logout">Logout</a>
            <?php else: ?>
                <a class="btn" href="/login">Login</a>
                <a class="btn" href="/register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
    
</body>
</html>