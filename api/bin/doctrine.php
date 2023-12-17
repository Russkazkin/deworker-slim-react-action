#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->get(EntityManagerInterface::class);

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
