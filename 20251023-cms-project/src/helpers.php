<?php

function isLoggedIn(): bool
{
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function currentUserId(): ?int
{
    return $_SESSION['user_id'] ?? null;
}

function getFlashMessage(): array {
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $messages;
}
