<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Shogomorisawa\Project\Models\Article;
use PDO;

class ArticleModelTest extends TestCase
{
    private const TEST_USER_ID = 1;
    private const TOTAL_ARTICLES = 15;
    private const ARTICLES_PER_PAGE = 10;

    private Article $articleModel;
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec('
            CREATE TABLE articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                content TEXT,
                image TEXT,
                user_id INTEGER,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )
        ');

        $this->pdo->exec('
            CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT
            )
        ');

        $stmt = $this->pdo->prepare('INSERT INTO users (username) VALUES (?)');
        $stmt->execute(['testuser']);

        $stmt = $this->pdo->prepare(
            'INSERT INTO articles (title, content, user_id) VALUES (?, ?, ?)',
        );

        for ($i = 1; $i <= self::TOTAL_ARTICLES; $i++) {
            $stmt->execute([
                "Dummy Article $i",
                "This is the content of article $i",
                self::TEST_USER_ID,
            ]);
        }

        $this->articleModel = new Article($this->pdo);
    }

    public function testGetArticlesByUserWithPagination(): void
    {
        $userId = self::TEST_USER_ID;

        $articlesPage1 = $this->articleModel->getArticlesByUser(
            $userId,
            0,
            self::ARTICLES_PER_PAGE,
            null,
        );
        $this->assertCount(self::ARTICLES_PER_PAGE, $articlesPage1);
        $this->assertSame('Dummy Article 1', $articlesPage1[0]['title']);

        $articlesPage2 = $this->articleModel->getArticlesByUser(
            $userId,
            self::ARTICLES_PER_PAGE,
            self::ARTICLES_PER_PAGE,
            null,
        );
        $this->assertCount(self::TOTAL_ARTICLES - self::ARTICLES_PER_PAGE, $articlesPage2);
        $this->assertSame('Dummy Article 11', $articlesPage2[0]['title']);
    }

    public function testCountArticlesByUser(): void
    {
        $userId = self::TEST_USER_ID;
        $count = $this->articleModel->countArticlesByUser($userId);
        $this->assertSame(self::TOTAL_ARTICLES, $count);
    }

    public function testGetArticlesByUserWithSearchKeyword(): void
    {
        $userId = self::TEST_USER_ID;
        $keyword = 'Dummy Article 5';
        $articles = $this->articleModel->getArticlesByUser(
            $userId,
            0,
            self::ARTICLES_PER_PAGE,
            $keyword,
        );

        $this->assertCount(1, $articles);
        $this->assertSame('Dummy Article 5', $articles[0]['title']);
    }
}
