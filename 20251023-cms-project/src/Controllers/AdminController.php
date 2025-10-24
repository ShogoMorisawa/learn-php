<?php

namespace Shogomorisawa\Project\Controllers;

class AdminController
{
    public function index(): string
    {
        ob_start();
        include __DIR__ . '/../views/admin.php';
        return ob_get_clean();
    }
}
