<?php

namespace App\AppBundle\Domain;

interface AppWorkflowInterface // @todo better way to split domain / infra ?
{
    public function apply(object $subject, string $transitionName, array $context = []): object; // @todo better way ?
}
