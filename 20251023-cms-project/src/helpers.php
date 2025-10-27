<?php

function isLoggedIn(): bool
{
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function currentUserId(): ?int
{
    return $_SESSION['user_id'] ?? null;
}

function getFlashMessage(): array
{
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $messages;
}

function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(string $token): bool
{
    if (empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

function csrfInput(): string
{
    return '<input type="hidden" name="_token" value="' . generateCsrfToken() . '">';
}

function rememberInput(array $data): void
{
    $_SESSION['old_input'] = $data;
}

function getOldInput(): array
{
    return $_SESSION['old_input'] ?? [];
}

function clearOldInput(): void
{
    if (isset($_SESSION['old_input'])) {
        unset($_SESSION['old_input']);
    }
}
