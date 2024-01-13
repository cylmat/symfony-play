<?php

namespace App\Test\ApiResource;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class RandomApiControllerTest extends WebTestCase
{
    public function testGetRandomIntAction(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/api/');

        // head
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('"random_int"', $client->getResponse()->getContent());
    }
}
