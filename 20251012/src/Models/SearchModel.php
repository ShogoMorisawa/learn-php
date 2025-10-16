<?php

namespace Shogomorisawa\PhpTemplate\Models;

class SearchModel
{
    public function search(string $query): array
    {
        // 実際のプロジェクトでは、ここでデータベースに問い合わせる
        // e.g., SELECT * FROM articles WHERE title LIKE '%$query%'

        // 仮の検索結果を返す（デモ用）
        $mockResults = [
            ['title' => 'PHPの基礎', 'content' => 'PHPの基本的な文法について'],
            ['title' => 'MVCパターン', 'content' => 'Model-View-Controllerの設計パターン'],
            ['title' => 'データベース設計', 'content' => 'リレーショナルデータベースの設計方法'],
        ];

        // クエリに一致する結果をフィルタリング（簡易検索）
        $results = [];
        foreach ($mockResults as $item) {
            if (
                stripos($item['title'], $query) !== false ||
                stripos($item['content'], $query) !== false
            ) {
                $results[] = $item;
            }
        }

        return $results;
    }
}
