<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;

class LoginController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLoginForm(): string
    {
        ob_start();
        include __DIR__ . '/../views/login.php';
        return ob_get_clean();
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->userModel->authenticate($username, $password)) {
            session_regenerate_id(true);
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $username;
            $this->redirect('/admin');
        } else {
            $_SESSION['error'] = 'ログインに失敗しました';
            $this->redirect('/login');
        }
    }

    private function redirect(string $url): string
    {
        header('location: ' . $url);
        exit();
    }
}
