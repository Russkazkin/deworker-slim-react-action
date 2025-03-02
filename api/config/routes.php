<?php

declare(strict_types=1);

use App\Http\Action\AuthorizeAction;
use App\Http\Action\HomeAction;
use App\Http\Action\TokenAction;
use App\Http\Action\V1\Auth\Join\ConfirmAction;
use App\Http\Action\V1\Auth\Join\RequestAction;
use App\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->get('/', HomeAction::class);

    $app->map(['GET', 'POST'], '/authorize', AuthorizeAction::class);
    $app->post('/token', TokenAction::class);

    $app->group('/v1', new Group(static function (RouteCollectorProxy $group): void {
        $group->group('/auth', new Group(static function (RouteCollectorProxy $group): void {
            $group->post('/join', RequestAction::class);
            $group->post('/join/confirm', ConfirmAction::class);
        }));
    }));
};
