<?php

declare(strict_types=1);

namespace App\Features;

use App\Encrypt\Application\EncryptAction;
use App\Encrypt\Domain\Manager\EncryptManager;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\Assert;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * \Behat\Mink\Session
 */
final class EncryptContext extends BaseContext
{
    /** @todo finish it */

    /**
     * @When the encrypt form is sended
     * @Then the encrypted value should be seen
     */
    public function encryptForm()
    {
        /** @var \Behat\Mink\Session $session */
        $session = $this->getSession();
        $this->visit('/encrypt');

        /** @var \Behat\Mink\Element\DocumentElement $page */
        $page = $session->getPage();
        $f = $page->findField('crypto_ClearDataToConvert')->setValue('test');
        $s =$page->findButton('crypto_Submit');
        $page->fillField('crypto_ClearDataToConvert', 'alpha');
        $a = $page->pressButton('crypto_Submit');

        /** @var \Behat\Mink\Element\NodeElement $res */
        $res = $page->findById('result');
        Assert::assertStringStartsWith("Result: $2y$", $res->getText());

        /** Symfony request */

        /*$action = new EncryptAction(new EncryptManager(new EncryptionFactory()));
        $result = $action->execute('a', []);
        preg_match('/^\$2y\$/', $result) || throw new \LogicException();*/
        /*$r = $this->handleRequest('/', 'POST', [
            'crypto[ClearDataToConvert]' => 'ar',
        ]);*/
    }
}

/*
 *
 *  array(31) {
      │   [0] =>
      │   string(8) "getXpath"
      │   [1] =>
      │   string(10) "getContent"
      │   [2] =>
      │   string(10) "hasContent"
      │   [3] =>
      │   string(8) "findById"
      │   [4] =>
      │   string(7) "hasLink"
      │   [5] =>
      │   string(8) "findLink"
      │   [6] =>
      │   string(9) "clickLink"
      │   [7] =>
      │   string(9) "hasButton"
      │   [8] =>
      │   string(10) "findButton"
      │   [9] =>
      │   string(11) "pressButton"
      │   [10] =>
      │   string(8) "hasField"
      │   [11] =>
      │   string(9) "findField"
      │   [12] =>
      │   string(9) "fillField"
      │   [13] =>
      │   string(15) "hasCheckedField"
      │   [14] =>
      │   string(17) "hasUncheckedField"
      │   [15] =>
      │   string(10) "checkField"
      │   [16] =>
      │   string(12) "uncheckField"
      │   [17] =>
      │   string(9) "hasSelect"
      │   [18] =>
      │   string(17) "selectFieldOption"
      │   [19] =>
      │   string(8) "hasTable"
      │   [20] =>
      │   string(17) "attachFileToField"
      │   [21] =>
      │   string(11) "__construct"
      │   [22] =>
      │   string(10) "getSession"
      │   [23] =>
      │   string(3) "has"
      │   [24] =>
      │   string(7) "isValid"
      │   [25] =>
      │   string(7) "waitFor"
      │   [26] =>
      │   string(4) "find"
      │   [27] =>
      │   string(7) "findAll"
      │   [28] =>
      │   string(7) "getText"
      │   [29] =>
      │   string(7) "getHtml"
      │   [30] =>
      │   string(12) "getOuterHtml"
      │ }
 */
