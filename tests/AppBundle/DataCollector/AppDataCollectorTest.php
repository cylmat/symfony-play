<?php

namespace App\Test\AppBundle\DataCollector;

use App\AppBundle\DataCollector\AppDataCollector;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AppDataCollectorTest extends TestCase
{
    private static AppDataCollector $static;
    private AppDataCollector $appDataCollector;

    public static function setUpBeforeClass(): void
    {
        self::$static = new AppDataCollector();
    }

    public function setUp(): void
    {
        $this->appDataCollector = self::$static;
    }

    public function testCollect(): void
    {
        $request = new Request([], [], [], [], [], ['REQUEST_METHOD' => 'PUT']);
        $this->assertNull(
            $this->appDataCollector->collect($request, new Response())
        );
    }

    /** @depends testCollect */
    public function testLateCollect(): void
    {
        $this->assertNull($this->appDataCollector->lateCollect());
    }

    /** @depends testLateCollect */
    public function testGetData(): void
    {
        $expects = [
            'method' => 'PUT',
            'data' => '1',
            'late' => true,
        ];
        $this->assertSame($expects, $this->appDataCollector->getData());
        $this->assertSame('1', $this->appDataCollector->getData('data'));
    }

    public function testGetTemplate(): void
    {
        $this->assertStringContainsString('@App', $this->appDataCollector->getTemplate());
    }
}
