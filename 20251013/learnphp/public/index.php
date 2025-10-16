<?php
// まず最初にComposerのオートローダーを読み込む（超重要）
require_once __DIR__ . '/../vendor/autoload.php';

use Shogomorisawa\Project\Router;

// ブラウザがリクエストしたURLを取得
$requestUri = $_SERVER['REQUEST_URI'];

// ルーターを使用してリクエストを処理
$router = new Router();
echo $router->handleRequest($requestUri);
