<?php

namespace App\Application\Actions\Cars;

use Throwable;
use App\Domain\Exceptions\InvalidCredentialsException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Services\Conectaas\AuthService;
use GuzzleHttp\Client;
use App\Application\Responder\JsonResponder;


class PlayerAction 
{
    public function __construct(
        private AuthService $authService,
        private Client $client,
        private JsonResponder $jsonResponder
    ) {}

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response, 
        array $args): ResponseInterface 
    {
        try {
            $acessToken = $this->authService->getAccessToken();
            if ($acessToken) {
                $responseGuzzle = $this->client->get('api/v1/cars/players', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $acessToken,
                        'Accept'        => 'application/json',
                    ]
                ]);

                $data = json_decode($responseGuzzle->getBody()->getContents(), true);

                return $this->jsonResponder->respond($response, $data);
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
