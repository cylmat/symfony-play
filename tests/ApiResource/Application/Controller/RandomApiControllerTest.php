<?php

namespace App\Test\ApiResource;

use App\ApiResource\Application\Controller\RandomApiController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class RandomApiControllerTest extends WebTestCase
{
    private RandomApiController $randomApiController;

    protected function setUp(): void
    {
        $this->randomApiController = new RandomApiController();
    }

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
