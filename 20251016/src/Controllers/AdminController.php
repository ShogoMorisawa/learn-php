<?php
namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;
use PDO;

class AdminController
{
    private UserModel $userModel;
    public function __construct(private PDO $pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function show(): string
    {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('location: /login');
            exit();
        }

        ob_start();
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../views/admin.php';
        return ob_get_clean();
    }

    public function edit(): void
    {
        $this->assertAuthenticated();

        if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: /admin');
        }

        $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (!$userId || $username === '' || $email === '') {
            $_SESSION['flash']['errors'] = ['ユーザー情報の更新に失敗しました。'];
            header('location: /admin');
            exit();
        }

        $result = $this->userModel->updateUser($userId, $username, $email);
        if ($result === true) {
            $_SESSION['flash']['status'] = 'ユーザー情報が更新されました。';
        } else {
            $_SESSION['flash']['errors'] = 'ユーザー情報の更新に失敗しました。';
        }
        header('location: /admin');
        exit();
    }

    public function delete(): void
    {
        $this->assertAuthenticated();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: /admin');
            exit();
        }

        $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

        if (!$userId) {
            $_SESSION['flash']['errors'] = ['削除対象のユーザーが指定されていません。'];
            header('location: /admin');
            exit();
        }

        $result = $this->userModel->deleteUser($userId);
        if ($result === true) {
            $_SESSION['flash']['status'] = 'ユーザーが削除されました。';
        } else {
            $_SESSION['flash']['errors'] = 'ユーザーの削除に失敗しました。';
        }
        header('location: /admin');
        exit();
    }

    private function assertAuthenticated(): void
    {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('location: /login');
            exit();
        }
    }
}
