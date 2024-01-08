<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Doctrine\Migrations\Tools\Console\Command;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);
$config = new PhpFile('migrations.php');

$dependencyFactory = DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));

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
    new Command\DiffCommand($dependencyFactory),
));

$cli->run();
