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
}
