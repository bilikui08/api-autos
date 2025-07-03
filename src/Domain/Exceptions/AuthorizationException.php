<?php

namespace App\Domain\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function __construct(string $message = "Unauthorized action.", int $code = 403, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}