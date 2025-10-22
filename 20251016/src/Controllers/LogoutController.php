<?php

namespace Shogomorisawa\Project\Controllers;

class LogoutController
{
    public function logout(): void
    {
        // Reset session data before regenerating to avoid stale information.
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        session_start();
        $_SESSION['flash']['status'] = 'ログアウトしました。';

        header('Location: /login');
        exit();
    }
}

