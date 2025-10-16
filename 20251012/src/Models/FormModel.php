<?php

namespace Shogomorisawa\PhpTemplate\Models;

class FormModel
{
    public function validate(string $username, string $email): array
    {
        $username_error = '';
        $email_error = '';

        // --- ユーザー名のバリデーション ---
        if (empty($username)) {
            $username_error = 'ユーザー名は必須です。';
        }

        // --- Eメールのバリデーション ---
        if (empty($email)) {
            $email_error = 'Eメールは必須です。';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = '無効なEメール形式です。';
        }

        return [
            'username_error' => $username_error,
            'email_error' => $email_error,
        ];
    }

    public function save(string $username, string $email): bool
    {
        // 実際のプロジェクトでは、ここでデータベースに保存する
        // e.g., INSERT INTO users (username, email) VALUES (?, ?)

        // デモ用：保存成功をシミュレート
        return true;
    }
}
