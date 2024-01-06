<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);
$connection = $entityManager->getConnection();
$config = new PhpFile('migrations.php');

$dependencyFactory = DependencyFactory::fromConnection($config, new ExistingConnection($connection));

$cli = new Application('Doctrine Migrations');
$cli->setCatchExceptions(true);

$cli->addCommands(array(
    new Command\DumpSchemaCommand($dependencyFactory),
    new Command\ExecuteCommand($dependencyFactory),
    new Command\GenerateCommand($dependencyFactory),
    new Command\LatestCommand($dependencyFactory),
    new Command\ListCommand($dependencyFactory),
    new Command\MigrateCommand($dependencyFactory),
    new Command\RollupCommand($dependencyFactory),
    new Command\StatusCommand($dependencyFactory),
    new Command\SyncMetadataCommand($dependencyFactory),
    new Command\VersionCommand($dependencyFactory),
));

$cli->run();
