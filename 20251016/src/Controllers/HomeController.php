<?php

namespace Shogomorisawa\Project\Controllers;

class HomeController
{
    public function index(): string
    {
        ob_start();
        include __DIR__ . '/../views/index.php';
        return ob_get_clean();
    }
}
