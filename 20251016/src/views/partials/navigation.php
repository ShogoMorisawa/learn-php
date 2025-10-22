<nav>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>

        <!-- When the user is logged in -->
         <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
        <li>
            <a href="/admin">Admin</a>
        </li>
        <li>
            <a href="/logout">Logout</a>
        </li>
        <?php else: ?>
        <li>
            <a href="/register">Register</a>
        </li>
        <li>
            <a href="/login">Login</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
