<?php

declare(strict_types=1);

namespace App\Features;

use App\Encrypt\Application\Action\EncryptAction;
use App\Encrypt\Domain\Manager\EncryptManager;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;

final class EncryptContext extends KernelContext
{
    /** @todo */

    /**
     * @When the encrypt form is sended
     * @Then the encrypted value should be seen
     */
    public function encryptForm()
    {
        /*$action = new EncryptAction(new EncryptManager(new EncryptionFactory()));
        $result = $action->execute('a', []);
        preg_match('/^\$2y\$/', $result) || throw new \LogicException();*/

        $r = $this->handleRequest('/', 'POST', [
            'crypto[ClearDataToConvert]' => 'ar',
        ]);
    }
}
