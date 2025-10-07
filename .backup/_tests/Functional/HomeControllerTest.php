<?php

namespace App\Test\AppBundle\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class HomeControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
