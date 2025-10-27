<?php

namespace Shogomorisawa\Project\Controllers;

class ContactController
{
    public function show(): string
    {
        $isAdminPage = false;
        $flash = getFlashMessage();

        ob_start();
        include __DIR__ . '/../views/contact.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/app.php';
        return ob_get_clean();
    }
}
