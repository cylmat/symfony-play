<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[Group('functional')]
final class FrontControllerTest extends WebTestCase
{
    public function testRun()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/front');

        // // head
        $this->assertTrue(true);
    }
}
