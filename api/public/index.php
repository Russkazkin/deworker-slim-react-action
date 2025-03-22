<?php

declare(strict_types=1);

use DI\Container;

use function App\env;


use function Sentry\init;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

if ($dsn = env('SENTRY_DSN')) {
    Sentry\init(['dsn' => $dsn]);
}

/** @var Container $container */
$container = require __DIR__ . '/../config/container.php';

$app = (require __DIR__ . '/../config/app.php')($container);

$app->run();
