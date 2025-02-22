<?php

declare(strict_types=1);

namespace App\OAuth\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

/**
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity]
#[ORM\Table(name: 'oauth_auth_codes')]
class AuthCode implements AuthCodeEntityInterface
{
    use AuthCodeTrait;
    use EntityTrait;
    use TokenEntityTrait;

    #[ORM\Column(type: Types::STRING, length: 80)]
    #[ORM\Id]
    protected string $identifier;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected DateTimeImmutable $expiryDateTime;

    #[ORM\Column(type: Types::GUID)]
    protected string|null $userIdentifier = null;
}
