<?php

declare(strict_types=1);

use App\Console\FixturesLoadCommand;
use App\Console\MailerCheckCommand;
use App\OAuth\Console\E2ETokenCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    FixturesLoadCommand::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @var array{fixture_paths:string[]} $config
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
                MailerCheckCommand::class,
                E2ETokenCommand::class,
            ],
            'fixture_paths' => [
                __DIR__ . '/../../src/Auth/Fixture',
            ],
        ],
    ],
];
