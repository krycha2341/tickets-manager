<?php

namespace App\Exceptions;

class PasswordMissingException extends ApiException
{
    protected $message = 'To create a user, you need to specify a password';
    protected $code = 422;
}
