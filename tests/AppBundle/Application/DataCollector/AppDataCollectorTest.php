<?php

namespace App\Test\AppBundle\Application\DataCollector;

use App\AppBundle\Application\DataCollector\AppDataCollector;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AppDataCollectorTest extends TestCase
{
    private static AppDataCollector $appDataCollector;

    public static function setUpBeforeClass(): void
    {
        self::$appDataCollector = new AppDataCollector();
    }

    public function testCollect(): void
    {
        $request = new Request([], [], [], [], [], ['REQUEST_METHOD' => 'PUT']);
        $this->assertNull(
            self::$appDataCollector->collect($request, new Response())
        );
    }

    /** @depends testCollect */
    public function testLateCollect(): void
    {
        $this->assertNull(self::$appDataCollector->lateCollect());
    }

    /** @depends testLateCollect */
    public function testGetData(): void
    {
        $expects = [
            'method' => 'PUT',
            'data' => '1',
            'late' => true,
        ];
        $this->assertSame($expects, self::$appDataCollector->getData());
        $this->assertSame('1', self::$appDataCollector->getData('data'));
    }

    public function testGetTemplate(): void
    {
        $this->assertStringContainsString('@App', self::$appDataCollector->getTemplate());
    }
}
