<?php

use PHPUnit\Framework\TestCase;
use Shogomorisawa\Project\Controllers\HomeController;

class HomeControllerTest extends TestCase
{
    public function testIndexReturnsCorrectString(): void
    {
        $controller = new HomeController();
        $response = $controller->index();

        // 応答が期待通りの文字列と等しいかチェックする
        $this->assertSame('トップページです', $response);
    }
}
