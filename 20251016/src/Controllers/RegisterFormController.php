<?php

namespace Shogomorisawa\Project\Controllers;

class RegisterFormController
{
    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/register.php';
        return ob_get_clean();
    }
}

