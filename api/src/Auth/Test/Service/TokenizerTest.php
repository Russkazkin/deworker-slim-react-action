<?php

declare(strict_types=1);

namespace App\Auth\Test\Service;

use App\Auth\Entity\User\Token;
use App\Auth\Service\Tokenizer;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Tokenizer::class)]
#[UsesClass(Token::class)]
#[UsesClass(TokenizerTest::class)]
final class TokenizerTest extends TestCase
{
    public function testSuccess(): void
    {
        $interval = new DateInterval('PT1H');
        $date = new DateTimeImmutable('+1 day');

        $tokenizer = new Tokenizer($interval);

        $token = $tokenizer->generate($date);

        self::assertEquals($date->add($interval), $token->getExpires());
    }
}
