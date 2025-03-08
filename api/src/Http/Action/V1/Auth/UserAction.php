<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Auth;

use App\Http\Middleware\Auth\Authenticate;
use App\Http\Response\JsonResponse;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class UserAction implements RequestHandlerInterface
{
    /**
     * @throws JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $identity = Authenticate::identity($request);

        return new JsonResponse([
            'id' => $identity->id,
        ]);
    }
}
