<?php

namespace App\AwsBundle\Service;

use Aws\Command;
use Aws\ElastiCache\ElastiCacheClient;
use Aws\Handler\GuzzleV6\GuzzleHandler;
use Aws\HandlerList;
use GuzzleHttp\Psr7\Request;
use Predis\Client;

/**
 * @doc
 *   https://docs.aws.amazon.com/AmazonElastiCache/latest/dg/AutoDiscovery.Using.ModifyApp.PHP.html
 *   https://docs.aws.amazon.com/fr_fr/AmazonElastiCache/latest/dg/auth-iam.html
 *
 *
 *  Amazon Resource Names
 *  https://docs.aws.amazon.com/fr_fr/IAM/latest/UserGuide/reference-arns.html
 */
final class ElastiCacheService
{
    public function __construct(
        // private readonly Client $redisClient,
    ) {
    }

    public function run()
    {


        $handler = function ($item) {
        };
        $this->redisClient->set('key', 'myvalue');

        // $c = ElastiCacheClient::factory([
        //     // 'key' => '<aws access key>',
        //     // 'secret' => '<aws secret key>',
        //     // 'api' => 'e',
        //     'endpoint' => 'tryit-valkey-cbuqb4.serverless.euw3.cache.amazonaws.com',
        //     'region' => 'eu-west-3c',
        //     // 'endpoint_provider' => function ($item) {

        //     // },
        //     'credentials' => [
        //         'key' => '<aws access key>',
        //         'secret' => '<aws secret key>',
        //     ]
        // ]);

        /** @var Command $cmd */
        // $list = $c->getApi()['operations'];
// dump(array_keys($list));
        // $cmd = $c->getCommand('CreateCacheCluster', ['CacheClusterId' => 'blop']);

        // handler : Aws\IdempotencyTokenMiddleware

        // $d = $c->execute($cmd);
        // dump($d);

        // $a = $d->getIterator();
        // dump($a);

        // $h = new HandlerList(
        //     function (Command $c) {
        //         //$i['data']['test'];

        //         return new class () {
        //             function wait () {
        //                 $g = new GuzzleHandler();
        //                 $r = new Request('GET', 'http://google.com');
        //                 //$g($c);

        //                 return $g($r);
        //             }
        //         };
        //     }
        // );
    }
}
