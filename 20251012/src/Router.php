<?php

namespace Shogomorisawa\PhpTemplate;

use Shogomorisawa\PhpTemplate\Controllers\HomeController;
use Shogomorisawa\PhpTemplate\Controllers\SearchController;
use Shogomorisawa\PhpTemplate\Controllers\FormController;

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
            '/' => [HomeController::class, 'index'],
            '/search' => [SearchController::class, 'search'],
            '/form' => [FormController::class, 'index'],
        ];
    }

    public function handleRequest(string $requestUri): string
    {
        // クエリパラメータを除去
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (isset($this->routes[$path])) {
            [$controllerClass, $method] = $this->routes[$path];

            $controller = new $controllerClass();
            return $controller->$method();
        }

        http_response_code(404);
        return 'ページが見つかりません';
    }
}
