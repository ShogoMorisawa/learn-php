<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="index">
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
<div class="hero">
    <div class="hero-content">
        <h1>Welcome to our PHP App</h1>
        <p>Securely login and manage your account with us</p>
        <div class="hero-buttons">
            <a class="btn" href="/login">Login</a>
            <a class="btn" href="/register">Register</a>
        </div>
    </div>
</div>
</div>
    
</body>
</html>