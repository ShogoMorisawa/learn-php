<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;
use Shogomorisawa\Project\Controllers\SetController;
use Shogomorisawa\Project\Controllers\ReadController;
use Shogomorisawa\Project\Controllers\DeleteController;
use Shogomorisawa\Project\Controllers\LoginController;
use Shogomorisawa\Project\Controllers\AdminController;
use Shogomorisawa\Project\Controllers\LogoutController;

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
                '/set' => [SetController::class, 'index'],
                '/read' => [ReadController::class, 'index'],
                '/delete' => [DeleteController::class, 'index'],
                '/login' => [LoginController::class, 'showLoginForm'],
                '/admin' => [AdminController::class, 'index'],
                '/logout' => [LogoutController::class, 'logout'],
            ],
            'POST' => [
                '/login' => [LoginController::class, 'login'],
            ],
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
