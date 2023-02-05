<?php

declare(strict_types=1);

use App\Http\Action\HomeAction;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();

$builder->addDefinitions([
    'config' => [
        'debug' => (bool) getenv('APP_DEBUG'),
    ],
    ResponseFactoryInterface::class => Di\get(ResponseFactory::class),
]);

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

(require __DIR__ . '/../config/middleware.php')($app, $container);
(require __DIR__ . '/../config/routes.php')($app);


$app->run();
