<?php

declare(strict_types=1);

use App\Http\Middleware\{ClearEmptyInput, DomainExceptionHandler, ValidationExceptionHandler};
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app): void {
    $app->add(DomainExceptionHandler::class);
    $app->add(ValidationExceptionHandler::class);
    $app->add(ClearEmptyInput::class);
    $app->addBodyParsingMiddleware();
    $app->add(ErrorMiddleware::class);
};
