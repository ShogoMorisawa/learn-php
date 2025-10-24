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
}
