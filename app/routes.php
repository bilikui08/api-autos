<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\IndexAction;
use App\Middleware\JwtMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    $redis = $container->get(\Predis\Client::class);

    $app->get('/', IndexAction::class);

    $app->post('/auth/login', LoginAction::class);



    //$app->post('/logout', LogoutAction::class);

    // $app->group('/api', function (RouteCollectorProxy $group) {
    //     $group->get('/secure-data', SecureDataAction::class);
    // })->add(new JwtMiddleware($secret, $redis));
};