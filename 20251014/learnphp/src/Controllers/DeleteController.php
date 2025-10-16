<?php

namespace Shogomorisawa\Project\Controllers;

class DeleteController
{
    function index(): string
    {
        setcookie('username', '', time() - 3600, '/', '', true, true);
        return '<p>' . 'クッキーを削除しました' . '</p>';
    }
}
