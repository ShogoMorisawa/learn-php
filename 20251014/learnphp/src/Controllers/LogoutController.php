<?php

namespace Shogomorisawa\Project\Controllers;

class LogoutController
{
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('location: /login');
        exit();
    }
}
