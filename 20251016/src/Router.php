<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;
use Shogomorisawa\Project\Controllers\RegisterController;

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
                '/register' => [RegisterController::class, 'showRegisterForm', true],
            ],
            'POST' => [
                '/register' => [RegisterController::class, 'register', true],
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
                global $connection;
                $controller = new $controllerClass($connection);
            } else {
                $controller = new $controllerClass();
            }
            return $controller->$method() ?? '';
        }

        http_response_code(404);
        return 'ページが見つかりません';
    }
}
