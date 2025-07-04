<?php

use Predis\Client as RedisClient;
use App\Domain\Services\Conectaas\AuthService;
use App\Middleware\CorsMiddleware;
use App\Application\Responder\JsonResponder;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client AS HttpClient;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

return [
    // Servicios
    RedisClient::class => fn() => new RedisClient([
        'scheme' => $_ENV['REDIS_SCHEME'],
        'host'   => $_ENV['REDIS_HOST'],
        'port'   => $_ENV['REDIS_PORT'],
    ]),
    HttpClient::class => fn() => new HttpClient([
        'base_uri' => $_ENV['API_CONECTAAS_BASE_URI'],
        'timeout'  => 5.0,
    ]),
    AuthService::class => DI\autowire(AuthService::class),
    CorsMiddleware::class => fn() => new CorsMiddleware(),
    JsonResponder::class => fn() => new JsonResponder(),
    Logger::class => function () {
        $logger = new Logger('api-autos');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));
        $logger->pushProcessor(new UidProcessor());
        return $logger;
    },
];
