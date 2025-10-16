<?php

namespace Shogomorisawa\Project\Models;

class UserModel
{
    public function authenticate(string $username, string $password): bool{
        $correctUsername = 'shogo';
        $correctPassword = '1234';

        return $username === $correctUsername && $password === $correctPassword;
    }
}