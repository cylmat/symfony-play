<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

// DG\BypassFinals::enable();

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
}
if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env.test');
}

$_ENV['APP_ENV']='test';
$_ENV['APP_DEBUG']=false;
if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

// Mandatory to avoid Phpunit error
// \Symfony\Component\ErrorHandler\ErrorHandler::register();

// Executes console command
// $console = sprintf('APP_ENV=%s php %s', $_ENV['APP_ENV'], __DIR__.'/../bin/console');

# passthru(sprintf('%s %s', $console, 'doctrine:schema:drop --force'));
# passthru(sprintf('%s %s', $console, 'doctrine:schema:create'));
# passthru(sprintf('%s %s', $console, 'doctrine:fixtures:load --no-interaction'));
