<?php

declare(strict_types=1);

namespace App\Auth\Command\JoinByEmail\Request;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class Command
{
    #[NotBlank]
    #[Email]
    public string $email = '';
    #[NotBlank]
    #[Length(min: 6)]
    public string $password = '';
}
