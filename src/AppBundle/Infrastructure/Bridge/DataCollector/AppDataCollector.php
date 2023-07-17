<?php

namespace App\AppBundle\Infrastructure\Bridge\DataCollector;

use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\HttpKernel\DataCollector\LateDataCollectorInterface;
use Throwable;

/** @see https://symfony.com/doc/current/profiler.html */
final class AppDataCollector extends AbstractDataCollector implements DataCollectorInterface, LateDataCollectorInterface
{
    // Called during kernel.response
    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
        $this->data = [
            'method' => $request->getMethod(),
            'data' => '1',
        ];
    }

    // Called during kernel.terminate
    public function lateCollect(): void
    {
        $this->data['late'] = true;
    }

    // ... for template ... //

    /** @return string[] */
    public function getData(?string $key = null): array|string
    {
        return $key ? $this->data[$key] : $this->data;
    }

    public static function getTemplate(): string
    {
        /* Namespace is from "App/AppBundle" so "App" only */
        /** @todo Change @App/AppBundle to @AppBundle */
        return '@App/app_collector.html.twig';
    }
}
