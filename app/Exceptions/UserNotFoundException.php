<?php

namespace App\Exceptions;

class UserNotFoundException extends ApiException
{
    protected $message = 'User not found';
    protected $code = 404;
}
