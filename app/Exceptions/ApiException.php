<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $message = 'Unknown exception';
    protected $code = 500;
}
