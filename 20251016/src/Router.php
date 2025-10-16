<?php

namespace Shogomorisawa\Project;

use Shogomorisawa\Project\Controllers\HomeController;

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
