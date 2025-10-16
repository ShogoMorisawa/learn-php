<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ</title>
</head>
<body>
    <h1>管理者ページ</h1>
    <p>ようこそ、<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>さん</p>
    <a href="/logout">ログアウト</a>
</body>
</html>