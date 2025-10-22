<?php
namespace Shogomorisawa\Project\Models;

use PDO;
use PDOException;

class UserModel
{
    public function __construct(private PDO $pdo) {}

    public function register(
        string $username,
        string $email,
        string $password,
        string $confirm_password,
    ): true|string {
        if ($password !== $confirm_password) {
            return 'パスワードが一致しません';
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $check = $this->pdo->prepare(
                'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1',
            );
            $check->execute([$username, $email]);
            if ($check->fetch()) {
                return 'そのユーザー名またはメールアドレスは既に使われています。';
            }

            $stmt = $this->pdo->prepare(
                'INSERT INTO users (username, email, password) VALUES (?, ?, ?)',
            );
            $stmt->execute([$username, $email, $hashed_password]);

            return true;
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062) {
                return 'そのユーザー名またはメールアドレスは既に使われています。';
            }
            return '内部エラーが発生しました。時間をおいて再度お試しください。';
        }
    }

    public function authenticate(string $username, string $password): bool
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, username, password FROM users WHERE username = ? LIMIT 1',
        );
        $stmt->execute([$username]);

        $row = $stmt->fetch();
        if (!$row) {
            return false;
        }
        return password_verify($password, $row['password']);
    }

    public function getAllUsers(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, username, email, reg_date FROM users ORDER BY id ASC',
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, username, email, reg_date FROM users WHERE id = ? LIMIT 1',
        );
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }

    public function updateUser(int $id, string $username, string $email): bool|string
    {
        if ($username === '' || $email === '') {
            return '未入力の項目があります。';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'メールアドレスの形式が正しくありません。';
        }
        try {
            $stmt = $this->pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
            $stmt->execute([$username, $email, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062) {
                return 'そのユーザー名またはメールアドレスは既に使われています。';
            }
            return '更新に失敗しました。時間をおいて再度お試しください。';
        }
    }

    public function deleteUser(int $id): bool|string
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return '削除に失敗しました。時間をおいて再度お試しください。';
        }
    }
}
