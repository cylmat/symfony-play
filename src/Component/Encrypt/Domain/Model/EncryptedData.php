<?php

namespace App\Encrypt\Domain\Model;

class EncryptedData
{
    public const PROCESS_TRANSITION = 'process';
    public const FINISH_TRANSITION = 'finish';

    /** @var int[] */
    private array $workflowPlace = [];

    public function __construct(
        private readonly string $value
    ) {}

    public function getValue(): string
    {
        return $this->value;
    }

    /** @param int[] $workflowPlace */
    public function setCurrentPlace(array $workflowPlace): void
    {
        $this->workflowPlace = $workflowPlace;
    }

    /** @return int[] */
    public function getCurrentPlace(): array
    {
        return $this->workflowPlace;
    }
}
