<?php

namespace App\Exceptions;

class CannotPerformActionOnTaskException extends ApiException
{
    protected $message = 'Given action can\'t be performed on that task!';
    protected $code = 409;
}
