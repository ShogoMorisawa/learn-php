<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\User;
use PDO;

class LoginController
{
    private User $userModel;
    public function __construct(private PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/login.php';
        return ob_get_clean();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit();
        }
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $errors = [];
        if ($email === '' || $password === '') {
            $errors[] = '未入力の項目があります。';
        }
        if ($errors) {
            $_SESSION['flash']['errors'] = $errors;
        }

        $result = $this->userModel->login($email, $password);
        if ($result) {
            session_regenerate_id(true);
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['flash']['status'] = 'ログインに成功しました。';
            header('Location: /admin');
        } else {
            $_SESSION['flash']['errors'] = ['ログインに失敗しました。再度お試しください。'];
            header('Location: /login');
        }
        exit();
    }
}
