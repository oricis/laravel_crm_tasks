<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

class CrmExpirationTimeRepository
{
    private static array $groups = [
        'One hour',
        'One day',
        'One week',
        'End of month',
    ];


    public static function get(): array
    {
        return self::$groups;
    }
}
