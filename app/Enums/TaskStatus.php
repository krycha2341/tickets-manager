<?php

namespace App\Enums;

enum TaskStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case TO_VERIFY = 'to_verify';
    case DONE = 'done';
}
