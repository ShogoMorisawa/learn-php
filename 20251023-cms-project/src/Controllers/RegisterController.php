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
        $isAdminPage = false;
        $flash = getFlashMessage();
        $oldInput = getOldInput();

        ob_start();
        include __DIR__ . '/../views/register.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit();
        }

        if (!verifyCsrfToken($_POST['_token'] ?? '')) {
            http_response_code(419);
            $_SESSION['flash']['errors'] = [
                'ページの有効期限が切れました。もう一度お試しください。',
            ];
            header('Location: /register');
            exit();
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        $errors = [];
        if (empty($username)) {
            $errors[] = 'ユーザー名は必須です。';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = '有効なメールアドレスを入力してください。';
        }
        if (empty($password) || strlen($password) < 3) {
            $errors[] = 'パスワードは3文字以上で入力してください。';
        }
        if ($password !== $confirm_password) {
            $errors[] = 'パスワードが一致しません。';
        }

        if ($errors) {
            $_SESSION['flash']['errors'] = $errors;
            rememberInput(['username' => $username, 'email' => $email]);
            header('Location: /register');
            exit();
        }

        $result = $this->userModel->register($username, $email, $password);
        if ($result) {
            $_SESSION['flash']['status'] = '登録が完了しました。ログインしてください。';
            clearOldInput();
            header('Location: /login');
        } else {
            $_SESSION['flash']['errors'] = ['登録に失敗しました。再度お試しください。'];
            header('Location: /register');
        }
        exit();
    }
}
