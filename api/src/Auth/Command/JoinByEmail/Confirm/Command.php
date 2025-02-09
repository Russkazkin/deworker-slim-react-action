<?php

declare(strict_types=1);

namespace App\Auth\Command\JoinByEmail\Confirm;

use Symfony\Component\Validator\Constraints\NotBlank;

final class Command
{
    #[NotBlank]
    public string $token = '';
}
