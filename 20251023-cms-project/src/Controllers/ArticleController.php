<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\Article;
use PDO;

class ArticleController
{
    private Article $articleModel;
    public function __construct(private PDO $pdo)
    {
        $this->articleModel = new Article($pdo);
    }

    public function show(int $id): string
    {
        $article = $this->articleModel->getArticleById($id);
        if (!$article) {
            http_response_code(404);
            return '記事が見つかりません';
        }

        $isAdminPage = false;
        $flash = getFlashMessage();

        ob_start();
        include __DIR__ . '/../views/article.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }
}
