<?php

namespace App\Domain\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct(string $message = "Invalid credentials provided.", int $code = 401, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}