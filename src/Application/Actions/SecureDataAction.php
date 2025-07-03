<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
class SecureDataAction 
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
    {
        $response->getBody()->write(json_encode(['msg' => 'Protegido']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}