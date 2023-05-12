<?php

namespace App\Test\Admin\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class DashboardControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();
    }
}
