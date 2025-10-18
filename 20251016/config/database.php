<?php

// SQLiteデータベース設定（簡単で設定不要）
$db_path = __DIR__ . '/../database.sqlite';

try {
    $pdo = new PDO("sqlite:$db_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ SQLiteデータベース接続成功！\n";
} catch (PDOException $e) {
    die('❌ データベース接続失敗: ' . $e->getMessage() . "\n");
}
