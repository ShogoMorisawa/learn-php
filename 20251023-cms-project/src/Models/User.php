<?php

namespace Shogomorisawa\Project\Models;

use PDO;

class User
{
    public function __construct(private PDO $pdo) {}

    public function register(string $username, string $email, string $password): bool
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare(
            'INSERT INTO users (username, email, password) VALUES (?, ?, ?)',
        );
        $stmt->execute([$username, $email, $hashed_password]);
        return $stmt->rowCount() > 0;
    }

    public function login(string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if (!$user) {
            return false;
        }
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        return true;
    }
}
