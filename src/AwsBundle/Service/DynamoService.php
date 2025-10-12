<?php

namespace App\AwsBundle\Service;

use Aws\Command;
use Aws\DynamoDb\DynamoDbClient;

/**
 * @doc
 *   https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_dynamodb_code_examples.html
 *   https://github.com/awsdocs/aws-doc-sdk-examples/tree/main/php/example_code/dynamodb#code-examples
 *   https://docs.aws.amazon.com/sdk-for-java/latest/developer-guide/credentials.html
 *
 *   Credentials
 *     https://us-east-1.console.aws.amazon.com/iam/home?region=eu-west-3#/users/details/<USER>?section=permissions
 *       + AmazonDynamoDBFullAccess
 *
 */
final class DynamoService
{
    public const LIST_TABLES = 'ListTables';

    public function __construct(
        private readonly string $iamKey,
        private readonly string $iamSecret,
        private readonly string $dynamoRegion
    ) {
    }

    public function run(string $command, array $args = []): array
    {
        $args = [
            'region' => $this->dynamoRegion,
            'credentials' => [
                'key' => $this->iamKey,
                'secret' => $this->iamSecret,
            ]
        ];
        $dynamoClient = new DynamoDbClient($args);

        // $api = ($dynamoClient->getApi());
        $cmd = $dynamoClient->getCommand($command, $args);

        /** @var \Aws\Result $r */
        $r = $dynamoClient->execute($cmd);

        $results = $r->toArray();
        if (array_key_exists('@metadata', $results)) {
            unset($results['@metadata']);
        }

        return $results;
    }
}
