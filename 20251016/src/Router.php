<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;
use Shogomorisawa\Project\Controllers\RegisterFormController;
use Shogomorisawa\Project\Controllers\RegisterController;
use Shogomorisawa\Project\Controllers\LoginFormController;
use Shogomorisawa\Project\Controllers\LoginController;
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
                '/' => [HomeController::class, 'index', false],
                '/register' => [RegisterFormController::class, 'show', false],
                '/login' => [LoginFormController::class, 'show', false],
            ],
            'POST' => [
                '/register' => [RegisterController::class, 'register', true],
                '/login' => [LoginController::class, 'login', true],
            ],
        ];
    }

    public function handleRequest(string $requestMethod, string $requestUri): string
    {
        // クエリパラメータを除去
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (isset($this->routes[$requestMethod][$path])) {
            [$controllerClass, $method, $needDB] = $this->routes[$requestMethod][$path];

            if ($needDB) {
                global $pdo;
                $controller = new $controllerClass($pdo);
            } else {
                $controller = new $controllerClass();
            }
            return $controller->$method() ?? '';
        }

        http_response_code(404);
        return 'ページが見つかりません';
    }
}
