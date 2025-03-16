<?php

declare(strict_types=1);

namespace App\OAuth\Entity;

use DateTimeImmutable;
use Lcobucci\JWT\UnencryptedToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use League\OAuth2\Server\Exception\OAuthServerException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AccessToken implements AccessTokenEntityInterface
{
    use AccessTokenTrait;
    use EntityTrait;
    use TokenEntityTrait;

    private ?string $userRole = null;

    /**
     * @param ScopeEntityInterface[] $scopes
     */
    public function __construct(ClientEntityInterface $client, array $scopes)
    {
        $this->setClient($client);

        foreach ($scopes as $scope) {
            $this->addScope($scope);
        }
    }

    /**
     * @throws OAuthServerException
     */
    public function __toString()
    {
        return $this->convertToJWT()->toString();
    }

    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }

    public function getUserRole(): ?string
    {
        return $this->userRole;
    }

    /**
     * @throws OAuthServerException
     */
    public function convertToJWT(): UnencryptedToken
    {
        $this->initJwtConfiguration();

        $userIdentifier = $this->getUserIdentifier();

        if ($userIdentifier === null) {
            throw new OAuthServerException('User is not found.', 101, 'invalid_user', 401);
        }

        return $this->jwtConfiguration->builder()
            ->permittedFor($this->getClient()->getIdentifier())
            ->identifiedBy($this->getIdentifier())
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($this->getExpiryDateTime())
            ->relatedTo($userIdentifier)
            ->withClaim('scopes', $this->getScopes())
            ->withClaim('role', $this->getUserRole())
            ->getToken($this->jwtConfiguration->signer(), $this->jwtConfiguration->signingKey());
    }
}
