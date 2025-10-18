<?php

namespace Shogomorisawa\Project\Controllers;

class HomeController
{
    public function index(): string
    {
        // データベース接続テスト
        require_once __DIR__ . '/../../config/database.php';

        if (isset($pdo)) {
            $version = $pdo->query('SELECT sqlite_version()')->fetchColumn();
            return '✅ SQLiteデータベース接続成功！<br>SQLiteバージョン: ' . $version;
        } else {
            return '❌ データベース接続失敗';
        }
    }
}
