<?php
session_start();
// まず最初にComposerのオートローダーを読み込む（超重要）
require_once __DIR__ . '/../vendor/autoload.php';

use Shogomorisawa\Project\Router;

// ブラウザがリクエストしたURLを取得
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// ルーターを使用してリクエストを処理
$router = new Router();
echo $router->handleRequest($requestMethod, $requestUri);
