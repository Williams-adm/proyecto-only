<?php

namespace App\Exceptions;

use Exception;

class InvalidFilterException extends Exception
{
    public function __construct($message = "Filtro inválido", $code = 400)
    {
        parent::__construct($message, $code);
    }
    
}
