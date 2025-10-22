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
<?php include __DIR__ . '/partials/navigation.php'; ?>

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
                            <form method="POST" style="display:inline-block;" action="/admin/edit">
                                <input type="hidden" name="user_id" value="<?php echo $user[
                                    'id'
                                ]; ?>">
                                <input type="text" name="username" value="<?php echo $user[
                                    'username'
                                ]; ?>" required>
                                <input type="email" name="email" value="<?php echo $user[
                                    'email'
                                ]; ?>" required>
                                <button class="edit" type="submit" name="edit_user">Edit</button>
                            </form>
                            <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');" action="/admin/delete">
                                <input type="hidden" name="user_id" value="<?php echo $user[
                                    'id'
                                ]; ?>">
                                <button class="delete" type="submit" name="delete_user">Delete</button>
                            </form>                        
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
