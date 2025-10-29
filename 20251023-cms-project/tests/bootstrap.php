<?php

// 1. オートローダーを読み込む
// (テストコードが Article::class などを見つけられるようにするため)
require_once __DIR__ . '/../vendor/autoload.php';

// 2. .env と DB接続を読み込む
// (テストが $_ENV や $pdo を（必要なら）参照できるようにするため)
require_once __DIR__ . '/../config/database.php';

// 3. ヘルパー関数を読み込む
// (テストが redirect() などを（モックする際に）認識できるようにするため)
require_once __DIR__ . '/../src/helpers.php';
