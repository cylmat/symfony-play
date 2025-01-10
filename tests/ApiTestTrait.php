<?php

trait ApiTestTrait
{
    protected static KernelBrowser $client;

    public function setUp(): void
    {
        static::createLoggedClient();
    }

    public static function createLoggedClient(): void
    {
        self::$client = static::createClient();
        self::$client->setServerParameter('HTTP_X-AUTH-TOKEN', $_ENV['APP_SECURITY_TOKEN']);
    }

    public function sendRequest(
        string $method,
        string $uri,
        array $parameters = [],
        array $files = [],
        array $server = [],
        ?string $content = null,
        bool $checkSuccess = true
    ): Response {
        self::$client->request($method, $uri, $parameters, $files, $server, $content);

        if ($checkSuccess) $this->assertResponseIsSuccessful();
        self::getClient()->getResponse()->sendHeaders();

        return self::getClient()->getResponse();
    }

    public function getJsonResponseContent(): array
    {
        return json_decode(self::getClient()->getResponse()->getContent(), true);
    }
}

