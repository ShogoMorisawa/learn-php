<?php

namespace Shogomorisawa\Project\Controllers;

class AboutController
{
    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/about.php';
        return ob_get_clean();
    }
}
