<?php

namespace App\Enums;

enum TaskAction: string
{
    case START = 'start';
    case CODE_REVIEW = 'code_review';
    case REVERT = 'revert';
    case RELEASE = 'release';
    case CLOSE = 'close';

    /**
     * @return string[] Array of all TaskStatus values
     */
    public static function values(): array
    {
        return array_map(fn (self $enum) => $enum->value, self::cases());
    }
}
