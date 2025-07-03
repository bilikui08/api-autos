<?php 

namespace App\Application\Actions;

class IndexAction
{
    public function __invoke($request, $response, $args)
    {
        $response->getBody()->write("Welcome to the API Autos!");
        return $response;
    }
}