<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class AwsControllerTest extends WebTestCase
{
    public function testRun()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/aws');

        // // head
        dump($client->getResponse()->getContent());
        die('rtyrtyrty');
        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h2', 'Encryption');

        // // submit
        // $form = $crawler->selectButton('Submit')->form();
        // $form['crypto[ClearDataToConvert]'] = 'alpha';

        // $client->submit($form, []);
        // $this->assertSelectorTextContains('#result', '$2y$');
    }
}
