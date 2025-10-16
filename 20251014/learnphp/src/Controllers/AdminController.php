<?php

namespace Shogomorisawa\Project\Controllers;

class AdminController
{
    public function index(): string
    {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('location: /login');
            exit();
        }

        ob_start();
        include __DIR__ . '/../views/admin.php';
        return ob_get_clean();
    }
}
