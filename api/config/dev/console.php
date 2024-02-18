<?php

declare(strict_types=1);

use App\Console\FixturesLoadCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    FixturesLoadCommand::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{fixture_paths:string[]} $config
         */
        $config = $container->get('config')['console'];

        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);

        return new FixturesLoadCommand(
            $em,
            $config['fixture_paths'],
        );
    },

    'config' => [
        'console' => [
            'commands' => [
                FixturesLoadCommand::class,
            ],
            'fixture_paths' => [
                __DIR__ . '/../../src/Auth/Fixture',
            ],
        ],
    ],
];
