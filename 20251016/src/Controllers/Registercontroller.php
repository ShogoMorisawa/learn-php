<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;

class RegisterController
{
    private UserModel $userModel;

    public function __construct(private $connection)
    {
        $this->userModel = new UserModel($connection);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // フォームから送られてきたデータを、安全な形にして変数に入れる
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'confirm_password' => $confirm_password,
            ];

            if ($this->userModel->register($data)) {
                header('Location: /login');
                exit();
            }
        }
    }
}
