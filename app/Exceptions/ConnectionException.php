<?php

namespace App\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct($message = "Error de conexión", $code = 503, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
