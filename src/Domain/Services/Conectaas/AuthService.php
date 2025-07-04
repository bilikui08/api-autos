<?php

namespace App\Domain\Services\Conectaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Predis\Client as RedisClient;

class AuthService
{
    public function __construct(
        private Client $httpClient,
        private RedisClient $redisClient
    ) {}
    public function getAccessToken(): string 
    {
        $username = $_ENV['API_CONECTAAS_USERNAME'] ?? '';
        $password = $_ENV['API_CONECTAAS_PASSWORD'] ?? '';
        $redisTimeout = $_ENV['REDIS_TIMEOUT'] ?? 1800; // Default to 30 minutes if not set

        try {
            $response = $this->httpClient->post('api/v1/token', [
                'json' => [
                    'username' => $username,
                    'password' => $password
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $accessToken = $data['accessToken'] ?? '';
            $this->redisClient->setex($accessToken, $redisTimeout, 1);
            return $accessToken;
        } catch (GuzzleException $e) {
            die( $e->getMessage() );
        }
    }
}
