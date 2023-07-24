<?php

namespace App\AppBundle\Infrastructure\Service\Output;

use App\AppBundle\Application\OutputInterface;

final class Output implements OutputInterface
{
    public function __construct(
        private readonly FormatterInterface $formatter,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function format(array $data): array
    {
        return $this->formatter->format($data);
    }

    public function validate(string $data): void
    {
        $this->validator->validate($data);
    }
}
