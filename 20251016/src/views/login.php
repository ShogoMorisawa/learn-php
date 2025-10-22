<!DOCTYPE html>
    <html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="login">
   
    <?php include __DIR__ . '/partials/navigation.php'; ?>
    
    <div class="container">
        <div class="form-container">
            <form method="POST" action="">
                <h2>Login</h2>
    
                <?php include __DIR__ . '/partials/flash.php'; ?>
    
                <label for="username">Username:</label><br>
                <input type="text" name="username" required><br><br>
    
                <label for="password">Password:</label><br>
                <input type="password" name="password" required><br><br>
    
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    
    <!-- Include Footer -->

</body>
</html>