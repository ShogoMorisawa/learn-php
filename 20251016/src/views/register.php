<!-- Include Header -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="register">
<?php include __DIR__ . '/partials/navigation.php'; ?>
    
<div class="container">
    <div class="form-container">
        <form method="POST" action="/register">
            <h2>Create your Account</h2>

            <?php include __DIR__ . '/partials/flash.php'; ?>

            <label for="username">Username:</label>
            <input placeholder="Enter your username" type="text" name="username" required>

            <label for="email">Email:</label>
            <input placeholder="Enter your email" type="email" name="email" required>

            <label for="password">Password:</label>
            <input placeholder="Enter your password" type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input placeholder="Confirm your password" type="password" name="confirm_password" required>

            <input type="submit" value="Register">
        </form>
    </div>
</div>
    
</body>
</html>

<!-- Include Footer -->