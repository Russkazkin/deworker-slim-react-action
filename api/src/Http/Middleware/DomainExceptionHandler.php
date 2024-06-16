<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\JsonResponse;
use DomainException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DomainExceptionHandler implements MiddlewareInterface
{
    /**
     * @throws JsonException
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface|JsonResponse {
        try {
            return $handler->handle($request);
        } catch (DomainException $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], 409);
        }
    }
}
