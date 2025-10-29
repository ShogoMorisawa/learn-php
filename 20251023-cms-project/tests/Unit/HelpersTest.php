<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
    }

    public function testIsLoggedInReturnsTrueWhenSessionFlagSet(): void
    {
        $_SESSION['is_logged_in'] = true;
        $this->assertTrue(isLoggedIn());

        $_SESSION['is_logged_in'] = false;
        $this->assertFalse(isLoggedIn());
    }

    public function testCurrentUserIdReturnsValueOrNull(): void
    {
        $this->assertNull(currentUserId());

        $_SESSION['user_id'] = 42;
        $this->assertSame(42, currentUserId());
    }

    public function testGetFlashMessageReturnsMessagesAndClearsSession(): void
    {
        $_SESSION['flash'] = [
            'status' => 'ok',
            'errors' => ['error1'],
        ];

        $messages = getFlashMessage();

        $this->assertSame('ok', $messages['status']);
        $this->assertSame(['error1'], $messages['errors']);
        $this->assertArrayNotHasKey('flash', $_SESSION);
    }

    public function testCsrfTokenGenerationAndVerification(): void
    {
        $token = generateCsrfToken();
        $this->assertNotEmpty($token);
        $this->assertSame($token, $_SESSION['csrf_token']);

        $this->assertTrue(verifyCsrfToken($token));
        $this->assertFalse(verifyCsrfToken('invalid-token'));
    }

    public function testRememberInputAndGetOldInput(): void
    {
        $data = ['title' => 'test', 'content' => 'body'];
        rememberInput($data);

        $oldInput = getOldInput();
        $this->assertSame($data, $oldInput);
    }

    public function testClearOldInputRemovesStoredData(): void
    {
        rememberInput(['foo' => 'bar']);
        clearOldInput();

        $this->assertSame([], getOldInput());
    }
}
