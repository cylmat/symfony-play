<?php

namespace App\Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class TextControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/text');

        $this->assertResponseIsSuccessful();
    }
}
