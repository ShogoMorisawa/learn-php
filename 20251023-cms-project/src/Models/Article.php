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
}
