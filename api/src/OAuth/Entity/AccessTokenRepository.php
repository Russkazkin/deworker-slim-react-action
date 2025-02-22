<?php

declare(strict_types=1);

namespace App\OAuth\Entity;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

final class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function getNewToken(
        ClientEntityInterface $clientEntity,
        array $scopes,
        ?string $userIdentifier = null
    ): AccessToken {
        $accessToken = new AccessToken($clientEntity, $scopes);

        if ($userIdentifier !== null && $userIdentifier !== '') {
            $accessToken->setUserIdentifier($userIdentifier);
        }

        return $accessToken;
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        // do nothing
    }

    public function revokeAccessToken(string $tokenId): void
    {
        // do nothing
    }

    public function isAccessTokenRevoked(string $tokenId): bool
    {
        return false;
    }
}
