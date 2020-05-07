<?php

namespace Code\Exceptions;

use Exception;
use Throwable;

class MyCustomException extends Exception
{
    public function __construct($message = "My Custom Message", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}