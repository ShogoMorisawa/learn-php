<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;
use Shogomorisawa\Project\Controllers\AboutController;
use Shogomorisawa\Project\Controllers\AdminController;
use Shogomorisawa\Project\Controllers\ContactController;
use Shogomorisawa\Project\Controllers\LoginController;
use Shogomorisawa\Project\Controllers\RegisterController;
use Shogomorisawa\Project\Controllers\ArticleController;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->defineRoutes();
    }

    private function defineRoutes(): void
    {
        $this->routes = [
            'GET' => [
                '/' => [HomeController::class, 'index', true],
                '/about' => [AboutController::class, 'show', false],
                '/admin' => [AdminController::class, 'index', true],
                '/admin/create' => [AdminController::class, 'showCreateForm', true],
                '/admin/edit/{id}' => [AdminController::class, 'showEditForm', true],
                '/contact' => [ContactController::class, 'show', false],
                '/login' => [LoginController::class, 'show', true],
                '/register' => [RegisterController::class, 'show', true],
                '/article/{id}' => [ArticleController::class, 'show', true],
            ],
            'POST' => [
                '/register' => [RegisterController::class, 'register', true],
                '/login' => [LoginController::class, 'login', true],
                '/admin/create' => [AdminController::class, 'createArticle', true],
                '/admin/edit/{id}' => [AdminController::class, 'editArticle', true],
            ],
        ];
    }

    public function handleRequest(string $requestMethod, string $requestUri): string
    {
        // クエリパラメータを除去
        $path = parse_url($requestUri, PHP_URL_PATH);

        // ルートを取得
        $routes = $this->routes[$requestMethod];

        foreach ($routes as $route => $handler) {
            // ルート定義（例: /article/{id}）を正規表現（例: #^/article/(\d+)$#）に変換
            // (\d+) は「1桁以上の数字」にマッチするという意味
            $regex = '#^' . str_replace('{id}', '(\d+)', $route) . '$#';

            if (preg_match($regex, $path, $matches)) {
                [$controllerClass, $method, $needDB] = $handler;
                if ($needDB) {
                    global $pdo;
                    $controller = new $controllerClass($pdo);
                } else {
                    $controller = new $controllerClass();
                }

                $params = $matches[1] ?? null;

                if ($params) {
                    return $controller->$method((int) $params) ?? '';
                }
                return $controller->$method() ?? '';
            }
        }

        http_response_code(404);
        return 'ページが見つかりません';
    }
}
