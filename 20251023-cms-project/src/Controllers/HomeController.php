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
        $page = (int) max(1, $_GET['page'] ?? 1);
        $articlesPerPage = 10;

        $totalArticles = $this->articleModel->countAllArticles();
        $totalPages = (int) max(1, ceil($totalArticles / $articlesPerPage));
        if ($page > $totalPages) {
            $page = min($page, $totalPages);
        }
        $offset = ($page - 1) * $articlesPerPage;

        $articles = $this->articleModel->getArticlePaginated($offset, $articlesPerPage);
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
