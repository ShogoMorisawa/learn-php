<?php

namespace Shogomorisawa\Project\Controllers;

class RegisterController
{
    public function __construct(private $connection) {}

    public function showRegisterForm(): string
    {
        ob_start();
        include __DIR__ . '/../views/register.php';
        return ob_get_clean();
    }

    public function register()
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
