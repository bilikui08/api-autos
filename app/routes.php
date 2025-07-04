<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Application\Actions\Cars\PlayerAction;
use App\Application\Actions\IndexAction;
use App\Middleware\JwtMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    $redis = $container->get(\Predis\Client::class);

    $app->get('/', IndexAction::class);

    //$app->post('/auth/login', LoginAction::class);
    //$app->post('/logout', LogoutAction::class);

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get('/cars/players', PlayerAction::class);
        


    });//->add(new JwtMiddleware($redis));
};