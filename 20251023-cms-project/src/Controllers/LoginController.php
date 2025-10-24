<?php

namespace Shogomorisawa\Project\Controllers;

class LoginController
{
    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/login.php';
        return ob_get_clean();
    }
}
