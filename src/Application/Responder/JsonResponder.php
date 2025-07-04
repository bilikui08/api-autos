<?php

namespace App\Application\Responder;

use Psr\Http\Message\ResponseInterface;

class JsonResponder 
{
    public function respond(ResponseInterface $response, array $data, int $status = 200): ResponseInterface 
    {
        $payload = [
            'status' => $status,
            'data'   => $data
        ];
        
        //var_dump($payload); exit;

        $response->getBody()->write(json_encode($payload));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
