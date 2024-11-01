<?php

declare(strict_types=1);

namespace App\Features;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * KernelContext
 * @see http://behat.org/en/latest/quick_start.html
 */
class BaseContext extends MinkContext implements Context
{
    protected ?Response $response;

    public function __construct(
        protected KernelInterface $kernel
    ) {
    }

    protected function handleRequest(string $uri, string $method, array $parameters = [], ...$params): Response
    {
        return $this->handle($this->request($uri, $method, $parameters, ...$params));
    }

    protected function request(string $uri, string $method, array $parameters = [], ...$params): Request
    {
        return Request::create($uri, $method, $parameters, ...$params);
    }

    protected function handle(Request $request): Response
    {
        return $this->kernel->handle($request);
    }
}
