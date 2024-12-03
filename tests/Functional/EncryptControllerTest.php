<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class EncryptControllerTest extends WebTestCase
{
    /*
     * SAMPLE: $client->submitForm('Submit', ['crypto[ClearDataToConvert]' => 'alpha']);
     */
    public function testEncrypt()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/encrypt');

        // head
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Encryption');

        // submit
        $form = $crawler->selectButton('Submit')->form();
        $form['crypto[ClearDataToConvert]'] = 'alpha';

        $client->submit($form, []);
        $this->assertSelectorTextContains('#result', '$2y$');
    }
}
