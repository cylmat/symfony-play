<?php

declare(strict_types=1);

namespace App\Features;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @see http://behat.org/en/latest/quick_start.html
 */
class KernelContext implements Context
{
    protected ?Response $response;

    public function __construct(
        protected KernelInterface $kernel
    ) {
    }

    protected function request(string $uri, string $method, ...$params): Request
    {
        return Request::create($uri, $method, ...$params);
    }

    protected function handleRequest(...$params): Response
    {
        return $this->handle($this->request(...$params));
    }

    protected function handle(Request $request): Response
    {
        return $this->kernel->handle($request);
    }
}
