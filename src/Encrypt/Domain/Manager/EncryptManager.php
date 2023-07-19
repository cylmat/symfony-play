<?php

namespace App\Encrypt\Domain\Manager;

use App\AppBundle\Domain\AppWorkflowInterface;
use App\Encrypt\Domain\Model\EncryptedData;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;

final class EncryptManager
{
    public function __construct(
        private readonly EncryptionFactory $factory,
        private readonly AppWorkflowInterface $workflow,
    ) {
    }

    /** @param int[] $options */
    public function encryptValue(string $algo, string $value, array $options = []): string
    {
        $encryptedData = $this->factory->create($algo)->encrypt($value, $options);
        $this->workflow->apply($encryptedData, EncryptedData::FINISH_TRANSITION);

        return $encryptedData->getValue();
    }
}
