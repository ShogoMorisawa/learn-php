<?php

namespace Shogomorisawa\Project\Controllers;

class Setcontroller
{
    public function index(): string
    {
        setcookie('username', 'shogo', time() + 3600, '/', '', true, true);
        return 'クッキーをセットしました！';
    }
}
