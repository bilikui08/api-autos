<?php

namespace App\Application\Actions\Auth;

use Throwable;
use App\Domain\Exceptions\InvalidCredentialsException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Services\Conectaas\AuthService;


class LoginAction 
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
    {
        $body = $request->getParsedBody();
        $user = $body['user'] ?? '';
        $pass = $body['pass'] ?? '';

        try {
            $token = $this->authService->getAccessToken();
            if ($token) {
                $response->getBody()->write(json_encode(['token' => $token]));
                return $response->withHeader('Content-Type', 'application/json');
            }
        } catch (InvalidCredentialsException $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        } catch (Throwable $e) {    
            $response->getBody()->write(json_encode(['error' => 'An error occurred while processing your request']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }
}
