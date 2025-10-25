<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\Article;
use PDO;

class HomeController
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
        include __DIR__ . '/../views/home.php';
        return ob_get_clean();
    }
}
