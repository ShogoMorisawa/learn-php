<?php

namespace Shogomorisawa\Project\Controllers;

class FormController
{
    public function showForm(): string
    {
        $htmlFile = __DIR__ . '/../../views/form.html';
        if (file_exists($htmlFile)) {
            return file_get_contents($htmlFile);
        }

        http_response_code(404);
        return 'フォームファイルが見つかりません';
    }

    public function upload(): string
    {
        // POSTリクエスト以外は受け付けない
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return '<p>不正なリクエストです</p>';
        }

        // 結果を格納するための配列を準備
        $errors = [];
        $success_files = [];
        $upload_dir = __DIR__ . '/../../public/uploads/';

        // uploadsディレクトリがなければ作成する
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // --- ループ処理で各ファイルをチェック ---
        foreach ($_FILES['file_upload']['name'] as $key => $name) {
            // ファイルが選択されていない空のエントリはスキップ
            if ($_FILES['file_upload']['error'][$key] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            // --- 各ファイルの情報を変数に格納 ---
            $error = $_FILES['file_upload']['error'][$key];
            $size = $_FILES['file_upload']['size'][$key];
            $tmp_name = $_FILES['file_upload']['tmp_name'][$key];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            // --- バリデーション（チェック） ---

            // 1. PHPのアップロードエラーをチェック
            if ($error === UPLOAD_ERR_OK) {
                // 2. ファイルサイズのチェック
                if ($size > 1024 * 1024 * 5) {
                    // 5MB
                    $errors[] = "「{$name}」: ファイルサイズが5MBを超えています。";
                    continue; // 次のファイルへ
                }

                // 3. ファイル形式のチェック
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx'];
                if (!in_array($ext, $allowed_exts)) {
                    $errors[] = "「{$name}」: 許可されていないファイル形式です。";
                    continue; // 次のファイルへ
                }

                // ✅ 全てのチェックを通過！ファイルを移動
                $target_path = $upload_dir . uniqid() . '_' . basename($name);
                if (move_uploaded_file($tmp_name, $target_path)) {
                    $success_files[] = $name;
                } else {
                    $errors[] = "「{$name}」: ファイルの移動中にサーバーエラーが発生しました。";
                }
            } else {
                // ❌ アップロード自体に失敗した場合
                $errors[] = "「{$name}」のアップロードに失敗しました。エラーコード: {$error}";
            }
        }

        // --- 最終的な結果をまとめて表示 ---
        $result_html = '';

        if (!empty($success_files)) {
            $result_html .= '<h2>アップロード成功</h2><ul>';
            foreach ($success_files as $file) {
                $result_html .= '<li>' . htmlspecialchars($file) . '</li>';
            }
            $result_html .= '</ul>';
        }

        if (!empty($errors)) {
            $result_html .= '<h2>アップロードエラー</h2><ul>';
            foreach ($errors as $error) {
                $result_html .= '<li>' . htmlspecialchars($error) . '</li>';
            }
            $result_html .= '</ul>';
        }

        if (empty($success_files) && empty($errors)) {
            return '<p>ファイルが選択されていません。</p><a href="/form">戻る</a>';
        }

        return $result_html . '<a href="/form">戻る</a>';
    }
}
