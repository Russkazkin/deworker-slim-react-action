<?php

declare(strict_types=1);

namespace App\Http\Test\Unit\Middleware;

use App\Http\Middleware\TranslatorLocale;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Symfony\Component\Translation\Translator;

/**
 * @internal
 */
#[CoversClass(TranslatorLocale::class)]
#[UsesClass(TranslatorLocaleTest::class)]
class TranslatorLocaleTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testDefault(): void
    {
        $translator = $this->createMock(Translator::class);
        $translator->expects(self::never())->method('setLocale');

        $middleware = new TranslatorLocale($translator);

        $handler = self::createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = self::createResponse());

        $response = $middleware->process(self::createRequest(), $handler);

        self::assertEquals($source, $response);
    }

    /**
     * @throws Exception
     */
    public function testAccepted(): void
    {
        $translator = $this->createMock(Translator::class);
        $translator->expects(self::once())->method('setLocale')->with(
            self::equalTo('ru')
        );

        $middleware = new TranslatorLocale($translator);

        $handler = self::createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn(self::createResponse());

        $request = self::createRequest()->withHeader('Accept-Language', 'ru');

        $middleware->process($request, $handler);
    }

    private static function createRequest(): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest('POST', 'http://test');
    }

    private static function createResponse(): ResponseInterface
    {
        return (new ResponseFactory())->createResponse();
    }
}
