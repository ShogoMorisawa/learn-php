<?php

namespace Shogomorisawa\Project\Controllers;

class LoginFormController
{
    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/login.php';
        return ob_get_clean();
    }
}
