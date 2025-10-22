<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;
use PDO;

class RegisterController
{
    private UserModel $userModel;

    public function __construct(private PDO $pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit();
        }
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];
        if ($username === '' || $email === '' || $password === '' || $confirm_password === '') {
            $errors[] = '未入力の項目があります。';
        }
        if ($password !== $confirm_password) {
            $errors[] = 'パスワードが一致しません。';
        }

        if ($errors) {
            $_SESSION['flash']['errors'] = $errors;
            $_SESSION['old'] = ['username' => $username, 'email' => $email];
            header('Location: /register');
            exit();
        }

        $result = $this->userModel->register($username, $email, $password, $confirm_password);
        if ($result === true) {
            $_SESSION['flash']['status'] = '登録が完了しました。ログインしてください。';
            header('Location: /login');
            exit();
        } else {
            $_SESSION['flash']['errors'] = [$result];
            $_SESSION['old'] = ['username' => $username, 'email' => $email];
            header('Location: /register');
            exit();
        }
    }
}
