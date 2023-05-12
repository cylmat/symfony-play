<?php

namespace App\Tests\AppBundle\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class TextControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/text');

        $this->assertResponseIsSuccessful();
    }
}
