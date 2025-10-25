<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\Article;
use PDO;

class AdminController
{
    private Article $articleModel;
    public function __construct(private PDO $pdo)
    {
        $this->articleModel = new Article($pdo);
    }

    public function index(): string
    {
        $this->checkAuth();
        ob_start();
        $articles = $this->articleModel->getAllArticles();
        include __DIR__ . '/../views/admin.php';
        return ob_get_clean();
    }

    public function create(): string
    {
        $this->checkAuth();
        ob_start();
        include __DIR__ . '/../views/create-article.php';
        return ob_get_clean();
    }

    public function edit(): string
    {
        $this->checkAuth();
        ob_start();
        include __DIR__ . '/../views/edit-article.php';
        return ob_get_clean();
    }

    private function checkAuth(): void
    {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            $_SESSION['flash']['errors'] = ['ログインが必要です。'];
            header('location: /login');
            exit();
        }
    }
}
