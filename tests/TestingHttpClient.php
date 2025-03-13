<?php

/**

service.yml
---------
when@test:
    services:
        _defaults:
            public: true

        testingHttpClient:
            class: App\Tests\TestingHttpClient
            decorates: 'http_client'
            arguments: ['@.inner', '%kernel.project_dir%']

        testingMdm:
            parent: testingHttpClient
            decorates: 'api.mdm'

        testingUserRequest:
            parent: testingHttpClient
            decorates: 'api.user_request'
*/

namespace App\Tests;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\DecoratorTrait;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpClientTrait;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Component\HttpClient\TraceableHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TestingHttpClient extends ScopingHttpClient 
{
    use DecoratorTrait, HttpClientTrait {
        DecoratorTrait::withOptions insteadof HttpClientTrait;
    }

    private string $projectDir;
    private string $serviceName;
    private array $clientData = [];
    private array $mockResponseOnUrls = [];

    public function __construct(HttpClientInterface $client, string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->client = $client ?? HttpClient::create();
    }

    public function setMockedResponseOnUrl(string $url): void
    {
        if (!in_array($url, $this->mockResponseOnUrls)) {
            $this->mockResponseOnUrls[] = $url;
        }
    }

    public function setRealResponseOnUrl(string $url): void
    {
        if ($search = array_search($url, $this->mockResponseOnUrls)) {
            array_splice($this->mockResponseOnUrls, $search, 1);
        }
    }

    private function isMockedUrl(string $url): bool
    {
        return in_array($url, $this->mockResponseOnUrls);
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $client = $this->isMockedUrl($url) ? $this->getMockedClient($method, $url, $options) : $this->client;

        $response = $client->request($method, $url, $options);

        $this->clientData[] = (object)[
            'request' => [
                'method' => $method,
                'url' => $url,
                'options' => $options
            ],
            'response' => $response
        ];

        return $response;
    }

    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    public function getHttpClientData(): ?array
    {
        return $this->clientData;
    }

    private function getMockedClient(string $method, string $url, array $options = []): HttpClientInterface
    {
        $jsonFileContent = json_decode($this->getApiJsonContentFromUrl($method, $url), true);

        $response = json_encode($jsonFileContent['response']);

        return new TraceableHttpClient(new MockHttpClient(new MockResponse($response)));
    }

    /**
     * Generate file path with pattern METHOD_url(without '<host>/api/', and with underscores)
     * for files in "local/api" directory
     *
     * exemple:
     *  - api called: POST https://myurl.com/api/  api/liste-demande/primary/123?query
     *  - become:     POST_liste-demande_primary_123.json
     * */
    private function getApiJsonContentFromUrl(string $method, string $url): string
    {
        $url = preg_replace('/^\/api/', '', $url); // remove "http://.../api" from url
        $apiJsonFile = sprintf('%s%s.json',
            strtoupper($method),
            str_replace('/', '_', $url)
        );
        $filePath = $this->projectDir . '/local/api/' . $apiJsonFile;

        if (!file_exists($filePath)) {
            throw new \Exception('File not found: ' . $filePath);
        }

        return file_get_contents($filePath);
    }
}




