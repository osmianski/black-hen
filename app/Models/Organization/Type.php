<?php

namespace App\Models\Organization;

enum Type: string
{
    case Admin = 'admin';

    public static function choices(): array
    {
        return [
            'Regular organization' => null,
            'Administrators' => self::Admin,
        ];
    }
}
