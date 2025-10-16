<?php

namespace Shogomorisawa\Project\Controllers;

class ReadController
{
    function index(): string
    {
        if (isset($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
        } else {
            $username = 'ゲスト';
        }
        return '<p>' . $username . 'さん、こんにちは！</p>';
    }
}
