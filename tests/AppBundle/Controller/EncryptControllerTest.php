<?php

namespace App\Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group functional
 */
class EncryptControllerTest extends WebTestCase
{
    public function testEncrypt()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/encrypt');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'cryptographique');

        /* $crawler = $client->submitForm('Submit', [
            'crypto[ClearDataToConvert]' => 'alpha',
        ]); */
        $form = $crawler->selectButton('Submit')->form();
        $form['crypto[ClearDataToConvert]'] = 'alpha';

        $client->submit($form, []);

        $this->assertSelectorTextContains('#result', 'Result: $2y$');
    }
}
