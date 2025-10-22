<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;
use PDO;

class LoginController
{
    private UserModel $userModel;
    public function __construct(private PDO $pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $_SESSION['flash']['errors'] = ['ユーザー名またはパスワードが未入力です。'];
            $_SESSION['old'] = ['username' => $username];
            header('Location: /login');
            exit();
        }

        if ($this->userModel->authenticate($username, $password)) {
            session_regenerate_id(true);
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['flash']['status'] = 'ログインに成功しました。';
            header('Location: /admin');
            exit();
        }
        $_SESSION['flash']['errors'] = ['ユーザー名またはパスワードが間違っています。'];
        $_SESSION['old'] = ['username' => $username];
        header('Location: /login');
        exit();
    }
}
