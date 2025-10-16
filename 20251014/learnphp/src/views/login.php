<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <title>ログインページ</title>
  </head>
  <body>
    <h1>ログインページ</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars(
            $_SESSION['error'],
            ENT_QUOTES,
            'UTF-8',
        ); ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="/login">
      <label for="username">ユーザー名</label>
      <input type="text" name="username" id="username" />
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" />
      <button type="submit">ログイン</button>
    </form>
  </body>
</html>