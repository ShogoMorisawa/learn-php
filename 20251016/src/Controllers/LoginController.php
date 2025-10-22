<?php

namespace Shogomorisawa\Project\Controllers;

use Shogomorisawa\Project\Models\UserModel;

class LoginController
{
    private UserModel $userModel;
    public function __construct(private $connection)
    {
        $this->userModel = new UserModel($connection);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

            if ($this->userModel->authenticate($username, $password)) {
                return 'ログインに成功しました';
            } else {
                return 'ログインに失敗しました';
            }
        }
    }
}
