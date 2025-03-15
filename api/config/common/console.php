<?php

declare(strict_types=1);

use App\OAuth\Console\ClearExpiredCommand;

return [
    'config' => [
        'console' => [
            'commands' => [
                ClearExpiredCommand::class,
            ],
        ],
    ],
];
