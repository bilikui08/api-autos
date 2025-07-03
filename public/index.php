<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use App\Middleware\CorsMiddleware;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$env = $_SERVER['APP_ENV'] ?? 'local';

// Ruta base
$basePath = dirname(__DIR__);

// Cargar el archivo .env.<ambiente>
$dotenv = Dotenv::createImmutable($basePath, ".env.$env");
$dotenv->load();

// Crear contenedor DI
$containerBuilder = new ContainerBuilder();

// Cargar las definiciones
$containerBuilder->addDefinitions(__DIR__ . '/../app/dependencies.php');

// Crear el contenedor
$container = $containerBuilder->build();

// Inyectar el contenedor a la app
AppFactory::setContainer($container);
$app = AppFactory::create();

// Middleware global
$app->add(CorsMiddleware::class);

// Habilitar el middleware de análisis del cuerpo de la solicitud
$app->addBodyParsingMiddleware(); 

// Cargar rutas
(require __DIR__ . '/../app/routes.php')($app);

// Ejecutar
$app->run();
