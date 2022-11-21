<?php

use App\Kernel;

ini_set('display_errors', 'off');
error_reporting(0);

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
