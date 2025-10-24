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

    public function create(): string
    {
        ob_start();
        include __DIR__ . '/../views/create-article.php';
        return ob_get_clean();
    }

    public function edit(): string
    {
        ob_start();
        include __DIR__ . '/../views/edit-article.php';
        return ob_get_clean();
    }
}
