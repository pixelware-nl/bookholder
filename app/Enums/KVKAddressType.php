<?php

namespace App\Enums;

enum KVKAddressType: string
{
    case CORRESPONDANCE = 'correspondentieadres';
    case VISIT = 'bezoekadres';

    public static function toArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
