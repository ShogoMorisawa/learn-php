<?php

namespace Shogomorisawa\Project\Models;

use PDO;
use PDOException;

class Article
{
    public function __construct(private PDO $pdo) {}

    public function create(string $title, string $content, string $image = '', int $userId): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO articles (title, content, image, user_id) VALUES (?, ?, ?, ?)',
            );
            $stmt->execute([$title, $content, $image, $userId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function edit(string $title, string $content, string $image = '', int $articleId): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?',
            );
            $stmt->execute([$title, $content, $image, $articleId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllArticles(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT articles.*, users.username as author_name FROM articles LEFT JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC',
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT articles.*, users.username as author_name FROM articles LEFT JOIN users ON articles.user_id = users.id WHERE articles.id = ? LIMIT 1',
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
