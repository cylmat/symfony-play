<?php

namespace App\AppBundle\Infrastructure\Manager;

use App\AppBundle\Domain\AppWorkflowInterface;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\Registry;

class AppWorkflowManager implements AppWorkflowInterface
{
    public function __construct(
        private readonly Registry $registry
    ) {
    }

    public function apply(object $subject, string $transitionName, array $context = []): Marking
    {
        return $this->registry->get($subject)->apply($subject, $transitionName, $context);
    }
}
