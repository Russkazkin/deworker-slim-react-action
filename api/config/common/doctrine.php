<?php

declare(strict_types=1);

use App\Auth;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return [
    EntityManagerInterface::class => static function (ContainerInterface $container): EntityManagerInterface {

        $settings = $container->get('config')['doctrine.php'];

        $config = ORMSetup::createAttributeMetadataConfiguration(
            $settings['metadata_dirs'],
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache_dir']
                ? new FilesystemAdapter($settings['cache_dir'], directory: $settings['base_cache_dir'])
                : new ArrayAdapter()
        );

        foreach ($settings['types'] as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        $connection = DriverManager::getConnection($settings['connection'], $config);

        return new EntityManager(
            $connection,
            $config
        );
    },

    'config' => [
        'doctrine.php' => [
            'dev_mode' => false,
            'base_cache_dir' => '/../../var/cache/doctrine.php',
            'cache_dir' => 'cache',
            'proxy_dir' => __DIR__ . '/../../var/cache/doctrine.php/proxy',
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => getenv('DB_HOST'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'dbname' => getenv('DB_NAME'),
                'charset' => 'utf-8'
            ],
            'metadata_dirs' => [
                __DIR__ . '/../../src/Auth/Entity',
            ],
        ],
    ],
];
