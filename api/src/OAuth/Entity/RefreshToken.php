<?php

declare(strict_types=1);

namespace App\OAuth\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;

/**
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity]
#[ORM\Table(name: 'oauth_refresh_tokens')]
class RefreshToken implements RefreshTokenEntityInterface
{
    use EntityTrait;
    use RefreshTokenTrait;

    #[ORM\Column(type: Types::STRING, length: 80)]
    #[ORM\Id]
    protected string $identifier;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected DateTimeImmutable $expiryDateTime;

    #[ORM\Column(type: Types::GUID, nullable: false)]
    private ?string $userIdentifier = null;

    public function setAccessToken(AccessTokenEntityInterface $accessToken): void
    {
        $this->accessToken = $accessToken;
        $this->userIdentifier = (string)$accessToken->getUserIdentifier();
    }

    public function getUserIdentifier(): ?string
    {
        return $this->userIdentifier;
    }
}
