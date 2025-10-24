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
        ob_start();
        $articles = $this->articleModel->getAllArticles();
        include __DIR__ . '/../views/admin.php';
        return ob_get_clean();
    }

    public function create(): string
    {
        ob_start();
        include __DIR__ . '/../views/create-article.php';
        return ob_get_clean();
    }

    public function edit(): string
    {
        ob_start();
        include __DIR__ . '/../views/edit-article.php';
        return ob_get_clean();
    }
}
