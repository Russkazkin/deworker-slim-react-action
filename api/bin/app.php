#!/usr/bin/env php
<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

use function Sentry\init;

require __DIR__ . '/../vendor/autoload.php';

if (getenv('SENTRY_DSN') !== false) {
    init(['dsn' => getenv('SENTRY_DSN'), 'traces_sample_rate' => 1.0]);
}

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

$cli = new Application('Console');

if (getenv('SENTRY_DSN') !== false) {
    $cli->setCatchExceptions(false);
}
/**
 * @var string[] $commands
 * @psalm-suppress MixedArrayAccess
 */
$commands = $container->get('config')['console']['commands'];

foreach ($commands as $name) {
    /** @var Command $command */
    $command = $container->get($name);
    $cli->add($command);
}

$cli->run();
