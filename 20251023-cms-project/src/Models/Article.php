<?php

namespace Shogomorisawa\Project\Models;

use PDO;

class Article
{
    public function __construct(private PDO $pdo) {}

    public function getAllArticles(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $article = $stmt->fetch();
        return $article ? $article : null;
    }
}
