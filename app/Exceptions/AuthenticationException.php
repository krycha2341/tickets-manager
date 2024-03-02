<?php

namespace App\Exceptions;

class AuthenticationException extends ApiException
{
    protected $message = 'Unauthorized';
    protected $code = 401;
}
