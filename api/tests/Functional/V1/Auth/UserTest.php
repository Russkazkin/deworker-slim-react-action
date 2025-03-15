<?php

declare(strict_types=1);

namespace Test\Functional\V1\Auth;

use JsonException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Test\Functional\AuthHeader;
use Test\Functional\Json;
use Test\Functional\WebTestCase;

/**
 * @internal
 */
final class UserTest extends WebTestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures([
            UserFixture::class,
        ]);
    }

    public function testGuest(): void
    {
        $response = $this->app()->handle(self::json('GET', '/v1/auth/user'));

        self::assertEquals(401, $response->getStatusCode());
    }

    /**
     * @throws JsonException
     */
    public function testUser(): void
    {
        $response = $this->app()->handle(
            self::json('GET', '/v1/auth/user')
                ->withHeader('Authorization', AuthHeader::for('00000000-0000-0000-0000-000000000001', 'user'))
        );

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($body = (string)$response->getBody());

        self::assertEquals([
            'id' => '00000000-0000-0000-0000-000000000001',
            'role' => 'user',
        ], Json::decode($body));
    }

    /**
     * @throws JsonException
     */
    public function testAdmin(): void
    {
        $response = $this->app()->handle(
            self::json('GET', '/v1/auth/user')
                ->withHeader('Authorization', AuthHeader::for('00000000-0000-0000-0000-000000000001', 'admin'))
        );

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($body = (string)$response->getBody());

        self::assertEquals([
            'id' => '00000000-0000-0000-0000-000000000001',
            'role' => 'admin',
        ], Json::decode($body));
    }
}
