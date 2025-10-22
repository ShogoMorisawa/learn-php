<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="stylesheet" href="/assets/css/admin.css">

</head>
<body class="admin">
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

<h1>Manage Users</h1>

<div class="container">
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars(
                            $user['reg_date'] ?? '-',
                            ENT_QUOTES,
                            'UTF-8',
                        ) ?></td>
                        <td>
                            <!-- 編集/削除フォームをここに -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">ユーザーが登録されていません。</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Include Footer -->
</body>
</html>
