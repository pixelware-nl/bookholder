<?php

namespace App\Enums;

enum ProductType: int
{
    case DEVELOPMENT = 0;
    case DOCUMENTATION = 1;
    case MEETING = 2;

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
