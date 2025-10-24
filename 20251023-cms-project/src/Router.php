<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;
use Shogomorisawa\Project\Controllers\AboutController;
use Shogomorisawa\Project\Controllers\AdminController;
use Shogomorisawa\Project\Controllers\ContactController;
use Shogomorisawa\Project\Controllers\LoginController;
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
                '/' => [HomeController::class, 'index'],
                '/about' => [AboutController::class, 'show'],
                '/admin' => [AdminController::class, 'index'],
                '/contact' => [ContactController::class, 'show'],
                '/login' => [LoginController::class, 'show'],
                '/register' => [RegisterController::class, 'show'],
            ],
            'POST' => [],
        ];
    }

    public function handleRequest(string $requestMethod, string $requestUri): string
    {
        // クエリパラメータを除去
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (isset($this->routes[$requestMethod][$path])) {
            [$controllerClass, $method] = $this->routes[$requestMethod][$path];

            $controller = new $controllerClass();
            return $controller->$method() ?? '';
        }

        http_response_code(404);
        return 'ページが見つかりません';
    }
}
