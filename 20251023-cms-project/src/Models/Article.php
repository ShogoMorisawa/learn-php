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

    public function delete(int $articleId): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM articles WHERE id = ?');
            $stmt->execute([$articleId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function uploadImage(array $image): ?string
    {
        if ($image['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($image['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        if ($image['size'] > 5 * 1024 * 1024) {
            return null;
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowed, true)) {
            return null;
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $targetPath = __DIR__ . '/../../public/uploads/' . $filename;

        if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
            return null;
        }

        return '/uploads/' . $filename;
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

    public function getArticleByIdForUser(int $articleId, int $userId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = ? AND user_id = ? LIMIT 1');
        $stmt->execute([$articleId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArticlesByUser(int $userId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT articles.*, users.username as author_name FROM articles LEFT JOIN users ON articles.user_id = users.id WHERE articles.user_id = ? ORDER BY articles.created_at DESC',
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
