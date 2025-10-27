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
        $isAdminPage = false;
        $flash = getFlashMessage();
        $oldInput = getOldInput();

        ob_start();
        include __DIR__ . '/../views/login.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit();
        }

        if (!verifyCsrfToken($_POST['_token'] ?? '')) {
            http_response_code(419);
            $_SESSION['flash']['errors'] = [
                'ページの有効期限が切れました。もう一度お試しください。',
            ];
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
            rememberInput(['email' => $email]);
            header('Location: /login');
            exit();
        }

        $result = $this->userModel->login($email, $password);
        if ($result) {
            session_regenerate_id(true);
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['flash']['status'] = 'ログインに成功しました。';
            clearOldInput();
            header('Location: /admin');
        } else {
            $_SESSION['flash']['errors'] = ['ログインに失敗しました。再度お試しください。'];
            rememberInput(['email' => $email]);
            header('Location: /login');
        }
        exit();
    }
}
