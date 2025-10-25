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

    public function show(): string
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        ob_start();
        include __DIR__ . '/../views/article.php';
        return ob_get_clean();
    }
}
