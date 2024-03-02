<?php

namespace App\Exceptions;

class TaskNotFoundException extends ApiException
{
    protected $message = 'Task could not be found';
    protected $code = 404;
}
