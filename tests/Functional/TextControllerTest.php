<?php

namespace App\Tests\AppBundle\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/** @group functional */
final class TextControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/text');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Text substitution');

        $form = $crawler->selectButton('Submit')->form();
        $form['text[text]'] = 'test';
        $form['text[pattern]'] = 'e';
        $form['text[replace]'] = 'y';

        $client->submit($form, []);
        $this->assertSelectorTextContains('#result', 'tyst');

        # @todo : messenger test
        # $this->getContainer()->get('messenger.transport.async_priority_normal');
        # $this->assertCount(1, $transport->getSent());
    }
}
