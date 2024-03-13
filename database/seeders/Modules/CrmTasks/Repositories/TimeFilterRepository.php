<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

class TimeFilterRepository
{
    private static array $timeFilters = [
        'TASKS TODAY',
        'TASKS TOMORROW',
        'TASKS NEXT WEEK',
        'TASKS NEXT MONTH',
        'TASKS NEXT (ALL)',
    ];

    public static function get(): array
    {
        return self::$timeFilters;
    }
}
