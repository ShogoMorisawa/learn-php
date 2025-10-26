<?php

namespace Shogomorisawa\Project\Controllers;

class LogoutController
{
    public function logout(): void
    {
        $_SESSION = [];
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        header('Location: /login');
        exit();
    }
}
