<?php

namespace Shogomorisawa\PhpTemplate\Controllers;

use Shogomorisawa\PhpTemplate\Models\FormModel;

class FormController
{
    private FormModel $formModel;

    public function __construct()
    {
        $this->formModel = new FormModel();
    }

    public function index(): string
    {
        // エラーメッセージを保存する変数を初期化
        $username_error = '';
        $email_error = '';
        $username = '';
        $email = '';

        // フォームがPOSTで送信された場合のみ処理を実行
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // --- データのサニタイズ ---
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));

            // --- バリデーション ---
            $validationResult = $this->formModel->validate($username, $email);
            $username_error = $validationResult['username_error'];
            $email_error = $validationResult['email_error'];

            // --- 最終判断 ---
            if (empty($username_error) && empty($email_error)) {
                // ✅ 成功時の処理
                return $this->renderSuccess($username, $email);
            }
        }

        // フォーム表示（エラーがある場合はエラーメッセージ付き）
        return $this->renderForm($username, $email, $username_error, $email_error);
    }

    private function renderForm(
        string $username,
        string $email,
        string $username_error,
        string $email_error,
    ): string {
        $html = file_get_contents(__DIR__ . '/../../views/form.html');

        // エラーメッセージを挿入
        if (!empty($username_error) || !empty($email_error)) {
            $errorHtml = "<div style='color: red;'>\n";
            if (!empty($username_error)) {
                $errorHtml .= '<p>' . htmlspecialchars($username_error) . "</p>\n";
            }
            if (!empty($email_error)) {
                $errorHtml .= '<p>' . htmlspecialchars($email_error) . "</p>\n";
            }
            $errorHtml .= "</div>\n";
            $html = str_replace('<div id="error-messages"></div>', $errorHtml, $html);
        }

        // フォームの値を設定
        $html = str_replace(
            'name="username" value=""',
            'name="username" value="' . htmlspecialchars($username) . '"',
            $html,
        );
        $html = str_replace(
            'name="email" value=""',
            'name="email" value="' . htmlspecialchars($email) . '"',
            $html,
        );

        return $html;
    }

    private function renderSuccess(string $username, string $email): string
    {
        $html = file_get_contents(__DIR__ . '/../../views/form-success.html');

        // 変数を置換
        $html = str_replace('{{ username }}', htmlspecialchars($username), $html);
        $html = str_replace('{{ email }}', htmlspecialchars($email), $html);

        return $html;
    }
}
