<?php

declare(strict_types=1);

use DI\Container;
use Slim\App;

use function Sentry\init;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

if (getenv('SENTRY_DSN') !== false) {
    init(['dsn' => getenv('SENTRY_DSN'), 'traces_sample_rate' => 1.0,]);
}

/** @var Container $container */
$container = require __DIR__ . '/../config/container.php';

/** @var App $app */
$app = (require __DIR__ . '/../config/app.php')($container);

$app->run();
