<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\User;
use PDO;

class RegisterController
{
    private User $userModel;
    public function __construct(private PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/register.php';
        return ob_get_clean();
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit();
        }
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        $errors = [];
        if ($username === '' || $email === '' || $password === '' || $confirm_password === '') {
            $errors[] = '未入力の項目があります。';
        }
        if ($password !== $confirm_password) {
            $errors[] = 'パスワードが一致しません。';
        }
        if ($errors) {
            $_SESSION['flash']['errors'] = $errors;
        }

        $result = $this->userModel->register($username, $email, $password);
        if ($result) {
            $_SESSION['flash']['status'] = '登録が完了しました。ログインしてください。';
            header('Location: /login');
        } else {
            $_SESSION['flash']['errors'] = ['登録に失敗しました。再度お試しください。'];
            header('Location: /register');
        }
        exit();
    }
}
