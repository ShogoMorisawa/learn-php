<?php

namespace Shogomorisawa\Project\Controllers;

class ContactController
{
    public function show(): string
    {
        ob_start();
        include __DIR__ . '/../views/contact.php';
        return ob_get_clean();
    }
}
