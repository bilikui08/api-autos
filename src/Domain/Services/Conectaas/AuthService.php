<?php

namespace App\Domain\Services\Conectaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthService
{
    public function __construct(
        private Client $httpClient
    ) {}
    public function getAccessToken(string $username, string $password): string 
    {
        try {
            // Llamar a la API de Conectaas para obtener el token
            $response = $this->httpClient->post('api/v1/token');
            $data = json_decode($response->getBody()->getContents(), true);
            return $data['accessToken'] ?? '';
        } catch (GuzzleException $e) {
            die( $e->getMessage() );
        }
    }
}
