<?php

declare(strict_types=1);

namespace App\Auth\Test\Entity\User\Token;

use App\Auth\Entity\User\Token;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 */
#[CoversClass(Token::class)]
#[UsesClass(ExpiresTest::class)]
final class ExpiresTest extends TestCase
{
    public function testNot(): void
    {
        $token = new Token(
            Uuid::uuid4()->toString(),
            $expires = new DateTimeImmutable()
        );

        self::assertFalse($token->isExpiredTo($expires->modify('-1 secs')));
        self::assertTrue($token->isExpiredTo($expires));
        self::assertTrue($token->isExpiredTo($expires->modify('+1 secs')));
    }
}
