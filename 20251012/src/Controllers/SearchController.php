<?php

namespace Shogomorisawa\PhpTemplate\Controllers;

use Shogomorisawa\PhpTemplate\Models\SearchModel;

class SearchController
{
    private SearchModel $searchModel;

    public function __construct()
    {
        $this->searchModel = new SearchModel();
    }

    public function search(): string
    {
        // GETメソッドでリクエストが来たかどうかをチェック
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // 1. $_GETから'query'の値を受け取り、サニタイズする
            $query = htmlspecialchars(trim($_GET['query'] ?? ''));

            // 2. クエリが空でないかをチェックする
            if (!empty($query)) {
                // Modelに検索処理を委譲
                $results = $this->searchModel->search($query);
                return $this->renderSearchResults($query, $results);
            } else {
                // クエリパラメータが存在しない場合はフォームを表示
                // クエリパラメータが存在するが空の場合はエラーメッセージを表示
                if (isset($_GET['query'])) {
                    return $this->renderSearchError();
                } else {
                    // デフォルトの検索フォームを表示
                    return file_get_contents(__DIR__ . '/../../views/search.html');
                }
            }
        }

        // POSTメソッドの場合はフォームを表示
        return file_get_contents(__DIR__ . '/../../views/search.html');
    }

    private function renderSearchResults(string $query, array $results): string
    {
        $html = "<h2>検索結果</h2>\n";
        $html .= '<p>検索クエリ: ' . htmlspecialchars($query) . "</p>\n";

        if (empty($results)) {
            $html .= "<p>検索結果が見つかりませんでした。</p>\n";
        } else {
            $html .= "<ul>\n";
            foreach ($results as $result) {
                $html .= '<li><strong>' . htmlspecialchars($result['title']) . '</strong><br>';
                $html .= htmlspecialchars($result['content']) . "</li>\n";
            }
            $html .= "</ul>\n";
        }

        $html .= '<p><a href="/search">新しい検索</a></p>';

        return $html;
    }

    private function renderSearchError(): string
    {
        return "<h2>エラー</h2>\n<p>検索クエリを入力してください。</p>\n<p><a href='/search'>検索ページに戻る</a></p>";
    }
}
