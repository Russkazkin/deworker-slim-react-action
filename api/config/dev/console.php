<?php

declare(strict_types=1);

use App\Console\FixturesLoadCommand;
use App\Console\MailerCheckCommand;
use App\OAuth\Console\E2ETokenCommand;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
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

    E2ETokenCommand::class => static function (ContainerInterface $container): E2ETokenCommand {
        /**
         * @psalm-suppress MixedArrayAccess
         * @var array{
         *    private_key_path:string,
         * } $config
         */
        $config = $container->get('config')['oauth'];

        return new E2ETokenCommand(
            $config['private_key_path'],
            $container->get(ClientRepositoryInterface::class)
        );
    },

    'config' => [
        'console' => [
            'commands' => [
                FixturesLoadCommand::class,
                MailerCheckCommand::class,
            ],
            'fixture_paths' => [
                __DIR__ . '/../../src/Auth/Fixture',
            ],
        ],
    ],
];
