<?php

namespace Shogomorisawa\PhpTemplate\Controllers;

include_once __DIR__ . '/../../config/database.php';

class RegisterController
{
    public function __construct(private $connection) {}

    public function register(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // フォームから送られてきたデータを、安全な形にして変数に入れる
            $username = mysqli_real_escape_string($this->connection, $_POST['username']);
            $email = mysqli_real_escape_string($this->connection, $_POST['email']);
            $password = mysqli_real_escape_string($this->connection, $_POST['password']);
            $confirm_password = mysqli_real_escape_string(
                $this->connection,
                $_POST['confirm_password'],
            );
        }
    }
}
