<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case TO_VERIFY = 'to_verify';
    case DONE = 'done';

    /**
     * @return string[] Array of all TaskStatus values
     */
    public static function values(): array
    {
        return array_map(fn (self $enum) => $enum->value, self::cases());
    }
}
