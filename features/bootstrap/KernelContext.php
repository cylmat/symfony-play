<?php

declare(strict_types=1);

namespace App\Features;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class KernelContext implements Context
{
    /** @var KernelInterface */
    protected $kernel;

    /** @var Response|null */
    protected $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
