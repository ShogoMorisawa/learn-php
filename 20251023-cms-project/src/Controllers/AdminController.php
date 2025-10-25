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

    public function showCreateForm(): string
    {
        $this->checkAuth();
        ob_start();
        include __DIR__ . '/../views/create-article.php';
        return ob_get_clean();
    }

    public function createArticle(): void
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/create');
            exit();
        }
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $userId = $_SESSION['user_id'];
        $result = $this->articleModel->create($title, $content, $image, $userId);
        if ($result === true) {
            $_SESSION['flash']['status'] = '記事が作成されました。';
            header('Location: /admin');
            exit();
        } else {
            $_SESSION['flash']['errors'] = ['記事の作成に失敗しました。'];
            header('Location: /admin/create');
            exit();
        }
    }

    public function edit(): string
    {
        $this->checkAuth();
        ob_start();
        include __DIR__ . '/../views/edit-article.php';
        return ob_get_clean();
    }

    public function checkAuth(): void
    {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            $_SESSION['flash']['errors'] = ['ログインが必要です。'];
            header('location: /login');
            exit();
        }
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['flash']['errors'] = ['ユーザーIDが見つかりません。'];
            header('location: /login');
            exit();
        }
    }
}
