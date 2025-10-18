<?php
// データベース接続テストスクリプト
require_once __DIR__ . '/config/database.php';

echo "=== データベース接続テスト ===\n";

if (isset($pdo)) {
    echo "✅ SQLiteデータベース接続成功！\n";
    echo "接続情報:\n";
    echo '- データベースファイル: ' . $db_path . "\n";

    // SQLiteバージョンを取得
    $version = $pdo->query('SELECT sqlite_version()')->fetchColumn();
    echo '- SQLiteバージョン: ' . $version . "\n";

    echo "\n✅ 接続テスト完了\n";
} else {
    echo "❌ データベース接続失敗\n";
}
