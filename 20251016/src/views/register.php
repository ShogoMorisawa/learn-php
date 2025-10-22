<!-- Include Header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="register">
    <nav>
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
    
            <!-- When the user is logged in -->
            <li>
                <a href="/admin">Admin</a>
            </li>
            <li>
                <a href="/logout">Logout</a>
            </li>
    
            <!-- When the user is not logged in -->
            <li>
                <a href="/register">Register</a>
            </li>
            <li>
                <a href="/login">Login</a>
            </li>
        </ul>
    </nav>
    
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