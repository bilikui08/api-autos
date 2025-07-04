<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Predis\Client;

class JwtMiddleware 
{
    private string $secret;
    private Client $redis;

    public function __construct(Client $redis) 
    {
        $this->redis = $redis;
    }

    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            return $this->unauthorized();
        }

        $token = $matches[1];
        if (!$this->redis->exists($token)) {
            return $this->unauthorized();
        }

        try {
            JWT::decode($token, new Key($this->secret, 'HS256'));
        } catch (\Exception $e) {
            return $this->unauthorized();
        }
        return $handler->handle($request);
    }

    private function unauthorized(): ResponseInterface 
    {
        $response = new Response();
        $response->getBody()->write(json_encode(['error' => 'Unauthorized']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
    }
}
