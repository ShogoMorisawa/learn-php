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
        $articles = $this->articleModel->getAllArticles();
        $isAdminPage = false;
        $flash = getFlashMessage();

        ob_start();
        include __DIR__ . '/../views/home.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }
}
