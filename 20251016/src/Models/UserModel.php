<?php

namespace Shogomorisawa\Project\Models;

class UserModel
{
    public function __construct(private $connection) {}

    public function register(array $data): bool|string
    {
        $username = mysqli_real_escape_string($this->connection, $data['username']);
        $email = mysqli_real_escape_string($this->connection, $data['email']);
        $password = mysqli_real_escape_string($this->connection, $data['password']);
        $confirm_password = mysqli_real_escape_string($this->connection, $data['confirm_password']);

        if ($password !== $confirm_password) {
            return 'パスワードが一致しません';
        }

        $sql_check = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
        $result_check = mysqli_query($this->connection, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            return 'そのユーザー名はすでに使用されています';
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql_insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        $result_insert = mysqli_query($this->connection, $sql_insert);

        if ($result_insert) {
            return true;
        } else {
            return 'ユーザー登録に失敗しました' . mysqli_error($this->connection);
        }
    }

    public function authenticate(string $username, string $password): bool
    {
        $sql_select_user = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result_select_user = mysqli_query($this->connection, $sql_select_user);
        if (mysqli_num_rows($result_select_user) === 1) {
            $user = mysqli_fetch_assoc($result_select_user);
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }
}
