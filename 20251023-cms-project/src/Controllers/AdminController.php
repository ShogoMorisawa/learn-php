<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\Article;
use PDO;

class AdminController
{
    private Article $articleModel;
    public function __construct(private PDO $pdo)
    {
        $this->articleModel = new Article($pdo);
    }

    public function index(): string
    {
        $this->checkAuth();

        $articles = $this->articleModel->getArticlesByUser(currentUserId());
        $isAdminPage = true;
        $flash = getFlashMessage();

        ob_start();
        include __DIR__ . '/../views/admin.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }

    public function showCreateForm(): string
    {
        $this->checkAuth();

        $isAdminPage = true;
        $flash = getFlashMessage();
        $oldInput = getOldInput();

        ob_start();
        include __DIR__ . '/../views/create-article.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }

    public function createArticle(): void
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/create');
            exit();
        }
        if (!verifyCsrfToken($_POST['_token'] ?? '')) {
            http_response_code(419);
            $_SESSION['flash']['errors'] = [
                'ページの有効期限が切れました。もう一度お試しください。',
            ];
            header('Location: /admin/create');
            exit();
        }
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $imagePath = $this->articleModel->uploadImage($_FILES['image']);
        if ($imagePath === null && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['flash']['errors'] = ['画像のアップロードに失敗しました。'];
            rememberInput(['title' => $title, 'content' => $content]);
            header('Location: /admin/create');
            exit();
        }
        $userId = currentUserId();
        $result = $this->articleModel->create($title, $content, $imagePath ?? '', $userId);
        if ($result === true) {
            $_SESSION['flash']['status'] = '記事が作成されました。';
            clearOldInput();
            header('Location: /admin');
            exit();
        } else {
            $_SESSION['flash']['errors'] = ['記事の作成に失敗しました。'];
            rememberInput(['title' => $title, 'content' => $content]);
            header('Location: /admin/create');
            exit();
        }
    }

    public function showEditForm(int $id): string
    {
        $this->checkAuth();

        $userId = currentUserId();
        $article = $this->articleModel->getArticleByIdForUser($id, $userId);
        if (!$article) {
            $_SESSION['flash']['errors'] = ['記事が見つかりません。'];
            header('Location: /admin');
            exit();
        }
        $isAdminPage = true;
        $flash = getFlashMessage();
        $oldInput = getOldInput();

        ob_start();
        include __DIR__ . '/../views/edit-article.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }

    public function editArticle(int $id): void
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin');
            exit();
        }
        if (!verifyCsrfToken($_POST['_token'] ?? '')) {
            http_response_code(419);
            $_SESSION['flash']['errors'] = [
                'ページの有効期限が切れました。もう一度お試しください。',
            ];
            header('Location: /admin/edit/' . $id);
            exit();
        }

        $userId = currentUserId();
        $article = $this->articleModel->getArticleByIdForUser($id, $userId);
        if (!$article) {
            $_SESSION['flash']['errors'] = ['記事が見つかりません。'];
            header('Location: /admin');
            exit();
        }

        $newTitle = trim($_POST['title'] ?? '');
        $newContent = trim($_POST['content'] ?? '');
        $oldImagePath = $article['image'] ?? null;
        $newImagePath = $this->articleModel->uploadImage($_FILES['image']) ?? null;
        $imagePathToSave = $newImagePath ?? $oldImagePath;

        if ($newImagePath === null && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['flash']['errors'] = ['画像の更新に失敗しました。'];
            rememberInput(['title' => $newTitle, 'content' => $newContent]);
            header('Location: /admin/edit/' . $id);
            exit();
        }

        if (!$newTitle || !$newContent) {
            $_SESSION['flash']['errors'] = ['タイトルと内容は必須です。'];
            rememberInput(['title' => $newTitle, 'content' => $newContent]);
            header('Location: /admin/edit/' . $id);
            exit();
        }

        $result = $this->articleModel->edit($newTitle, $newContent, $imagePathToSave, $id);
        if ($result === true) {
            $_SESSION['flash']['status'] = '記事の更新に成功しました。';
            clearOldInput();

            if ($newImagePath !== null) {
                if (
                    !empty($oldImagePath) &&
                    file_exists(__DIR__ . '/../../public/' . $oldImagePath)
                ) {
                    unlink(__DIR__ . '/../../public/' . $oldImagePath);
                }
            }

            header('Location: /admin');
            exit();
        } else {
            $_SESSION['flash']['errors'] = ['記事の更新に失敗しました。'];
            rememberInput(['title' => $newTitle, 'content' => $newContent]);
            header('Location: /admin/edit/' . $id);
            exit();
        }
    }

    public function deleteArticle(int $id): void
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin');
            exit();
        }
        if (!verifyCsrfToken($_POST['_token'] ?? '')) {
            http_response_code(419);
            $_SESSION['flash']['errors'] = [
                'ページの有効期限が切れました。もう一度お試しください。',
            ];
            header('Location: /admin');
            exit();
        }

        $userId = currentUserId();
        $article = $this->articleModel->getArticleByIdForUser($id, $userId);
        if (!$article) {
            $_SESSION['flash']['errors'] = ['記事が見つかりません。'];
            header('Location: /admin');
            exit();
        }

        $result = $this->articleModel->delete($id);
        if ($result === true) {
            $_SESSION['flash']['status'] = '記事が削除されました。';

            if (
                !empty($article['image']) &&
                file_exists(__DIR__ . '/../../public/' . $article['image'])
            ) {
                unlink(__DIR__ . '/../../public/' . $article['image']);
            }

            header('Location: /admin');
            exit();
        } else {
            $_SESSION['flash']['errors'] = ['記事の削除に失敗しました。'];
            header('Location: /admin');
            exit();
        }
    }

    public function checkAuth(): void
    {
        if (!isLoggedIn()) {
            $_SESSION['flash']['errors'] = ['ログインが必要です。'];
            header('location: /login');
            exit();
        }
        if (!currentUserId()) {
            $_SESSION['flash']['errors'] = ['ユーザーIDが見つかりません。'];
            header('location: /login');
            exit();
        }
    }
}
