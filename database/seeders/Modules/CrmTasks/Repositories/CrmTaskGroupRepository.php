<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

class CrmTaskGroupRepository
{
    private static array $groups = [
        [
            'title' => 'Default',
        ],
        [
            'title' => 'Demo',
            'description' => 'This is a demo group',
        ],
    ];


    public static function get(): array
    {
        return self::$groups;
    }
}
