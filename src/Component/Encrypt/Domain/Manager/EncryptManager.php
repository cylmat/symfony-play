<?php

namespace App\Encrypt\Domain\Manager;

use App\Encrypt\Domain\Model\EncryptedData;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use Symfony\Component\Workflow\WorkflowInterface;

class EncryptManager
{
    public function __construct(
        private readonly EncryptionFactory $factory,
        private readonly WorkflowInterface $encryptWorkflow
    ) {
    }

    /** @param int[] $options */
    public function encryptValue(string $algo, string $value, array $options = []): string
    {
        $encryptedData = $this->factory->create($algo)->encrypt($value, $options);
        $this->encryptWorkflow->apply($encryptedData, EncryptedData::FINISH_TRANSITION);

        return $encryptedData->getValue();
    }
}
