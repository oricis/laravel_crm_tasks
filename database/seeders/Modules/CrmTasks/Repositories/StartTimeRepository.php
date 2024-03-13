<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

class StartTimeRepository
{
    private static array $groups = [
        'Every 5th of March of each year',
        'Every 5th of each month',
        'Every Monday',
        'Every day',
        'Wednesday and Friday',
    ];


    public static function get(): array
    {
        return self::$groups;
    }
}
